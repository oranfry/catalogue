<?php
namespace catalogue\linetype;
use Config;

class sale extends \Linetype
{
    public function __construct()
    {
        $this->table = 'sale';
        $this->label = 'Sale';
        $this->printable = 'true';
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'piggybank'",
                'derived' => true,
            ],
            (object) [
                'name' => 'date',
                'type' => 'date',
                'fuse' => 't.date',
                'main' => true,
            ],
            (object) [
                'name' => 'orderid',
                'type' => 'text',
                'fuse' => 't.orderid',
            ],
            (object) [
                'name' => 'name',
                'type' => 'text',
                'fuse' => 't.name',
            ],
            (object) [
                'name' => 'email',
                'type' => 'text',
                'fuse' => 't.email',
            ],
            (object) [
                'name' => 'street',
                'type' => 'text',
                'fuse' => 't.street',
            ],
            (object) [
                'name' => 'suburb',
                'type' => 'text',
                'fuse' => 't.suburb',
            ],
            (object) [
                'name' => 'postcode',
                'type' => 'text',
                'fuse' => 't.postcode',
            ],
            (object) [
                'name' => 'currency',
                'type' => 'text',
                'fuse' => 't.currency',
            ],
            (object) [
                'name' => 'txid',
                'type' => 'text',
                'fuse' => "t.txid",
            ],
        ];
        $this->unfuse_fields = [
            't.date' => ':date',
            't.orderid' => ':orderid',
            't.name' => ':name',
            't.email' => ':email',
            't.street' => ':street',
            't.suburb' => ':suburb',
            't.postcode' => ':postcode',
            't.currency' => ':currency',
            't.txid' => ":txid",
        ];
        $this->children = [
            (object) [
                'label' => 'transactions',
                'linetype' => 'transaction',
                'rel' => 'many',
                'parent_link' => 'saletransaction',
                'list_fields' => [
                    (object) [
                        'name' => 'date',
                        'type' => 'date',
                        'id' => true,
                    ],
                    (object) [
                        'name' => 'net',
                        'type' => 'number',
                        'dp' => 2
                    ],
                    (object) [
                        'name' => 'gst',
                        'type' => 'number',
                        'dp' => 2
                    ],
                    (object) [
                        'name' => 'amount',
                        'type' => 'number',
                        'dp' => 2
                    ],
                    (object) [
                        'name' => 'description',
                        'type' => 'text',
                    ],
               ],
           ],
           (object) [
                'label' => 'stocktransfers',
                'linetype' => 'stocktransfer',
                'rel' => 'many',
                'parent_link' => 'salestocktransfer',
                'list_fields' => [
                    (object) [
                        'name' => 'date',
                        'type' => 'date',
                        'id' => true,
                    ],
                    (object) [
                        'name' => 'sku',
                        'type' => 'text',
                    ],
                    (object) [
                        'name' => 'amount',
                        'type' => 'number',
                    ],
                    (object) [
                        'name' => 'price',
                        'type' => 'number',
                        'dp' => 2,
                        'summary' => 'sum',
                    ],
                ],
            ],
            (object) [
                'label' => 'vouchercodes',
                'linetype' => 'vouchercode',
                'rel' => 'many',
                'parent_link' => 'salevouchercode',
                'list_fields' => [
                    (object) [
                        'name' => 'code',
                        'type' => 'text',
                    ],
                ],
            ],
        ];
    }

    public function complete($line)
    {
        if (!@$line->orderid) {
            $line->orderid = @$line->order ?: newid();
        }
    }

    public function validate($line)
    {
        $errors = [];

        if (@$line->date == null) {
            $errors[] = 'no date';
        }

        return $errors;
    }

    public function ashtml($line, $child_sets)
    {
        $output = '';

        $output .= '<!DOCTYPE html>';
        $output .= '<html lang="en-NZ">';
        $output .= '<head>';
        $output .= '<style>';
        $output .= 'html, body { margin: 0; padding: 0; font-size: 3.5mm; font-family: monospace; } ';
        $output .= '.receipt { width: 42ch; margin: 0 auto; padding: 3em 1em; border: 1px solid black; overflow: hidden; } ';
        $output .= 'pre { margin: 0; padding: 0; width: 100%; }';
        $output .= '</style>';
        $output .= '</head>';
        $output .= '<body>';
        $output .= '<div class="receipt">';
        $output .= '<img src="' . Config::get()->logopath . '" alt="" style="display: block; width: 50%; height: auto; margin: 0 auto 2em;">';
        $output .= "<pre>";
        $output .= wordwrap($this->astext($line, $child_sets), 42, "\n", true);
        $output .= "</pre>";
        $output .= '</div>';
        $output .= '</body>';
        $output .= '</html>';

        return $output;
    }

    public function astext($line, $child_sets)
    {
        $skumetas = get_sku_meta();

        $printout = '';

        $printout .= str_pad("TAX INVOICE", 42, " ", STR_PAD_BOTH) . "\n\n";
        $printout .= str_pad("Kayoh Kitchen", 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= str_pad("GST Number: 122-236-064", 42, " ", STR_PAD_BOTH) . "\n";

        $printout .= "\n";
        $datef = date('d/m/Y', strtotime($line->date));

        $printout .= "Date         {$datef}\n";
        $printout .= "Invoice      {$line->orderid}\n";

        if ($line->name) {
            $printout .= "Billed To    {$line->name}\n";

            if (@$line->street && @$line->suburb) {
                $printout .= str_replace("\n", "\n             ", wordwrap("Address      {$line->street}\n{$line->suburb}\nAuckland {$line->postcode}", 42)) . "\n";
            } elseif ($line->street) {
                $printout .= str_replace("\n", "\n             ", wordwrap("Address      {$line->street}", 42)) . "\n";
            }
        }

        $printout .= "\n";

        $gst = '0.00';
        $total = '0.00';

        foreach ($child_sets['transactions']->lines as $t => $transaction) {
            $gst = bcadd($gst, $transaction->gst, 2);
            $total = bcadd($total, $transaction->amount, 2);
        }

        $gstf = '$' . number_format($gst, 2, '.', '');
        $totalf = '$' . number_format($total, 2, '.', '');

        $datemeta = [];

        foreach ($child_sets['stocktransfers']->lines as $s => $stocktransfer) {
            if (!@$datemeta[$stocktransfer->date]) {
                $datemeta[$stocktransfer->date] = (object) ['method' => 'Pickup'];
            }

            if ($stocktransfer->sku == 'delivery') {
                $datemeta[$stocktransfer->date]->method = 'Delivery';
            }
        }

        $date = null;
        $linestotal = '0.00';

        foreach ($child_sets['stocktransfers']->lines as $s => $stocktransfer) {
            $meta = @$skumetas[$stocktransfer->sku];

            if ($date != $stocktransfer->date) {
                $printout .= "\n" . str_pad('- ' . $datemeta[$stocktransfer->date]->method . ' ' . date('D j M, Y', strtotime($stocktransfer->date)) . ' -', 42, ' ', STR_PAD_BOTH) . "\n\n";
                $date = $stocktransfer->date;
            }

            $printout .= $this->lineitem(
                @$meta->title ?: $stocktransfer->sku,
                0 - $stocktransfer->amount,
                @$meta->unit ?: '',
                $stocktransfer->price
            );

            $linestotal = bcadd($linestotal, $stocktransfer->price, 2);
        }

        $hasvoucher = false;

        foreach ($child_sets['vouchercodes']->lines as $voucher) {
            if ($voucher->nzd) {
                if (!$hasvoucher) {
                    $printout .= "\n" . str_pad('- Credits -', 42, ' ', STR_PAD_BOTH) . "\n\n";
                }

                $vouchervalue = $linestotal < $voucher->nzd ? $linestotal : $voucher->nzd;
                $printout .= $this->lineitem('Voucher', $voucher->code, '', bcmul('-1', $vouchervalue, 2));
                $linestotal = bcsub($linestotal, $vouchervalue, 2);
                $hasvoucher = true;
            }
        }

        if (count($child_sets['stocktransfers']->lines) || $hasvoucher) {
            $printout .= "\n";

            $printout .= str_repeat("-", 42) . "\n";
            $printout .= "\n";
            $printout .= "Total " . str_pad('$' . $linestotal, 42 - 6, ' ', STR_PAD_LEFT) . "\n\n";
        }

        $printout .= str_pad("(Paid {$totalf} including GST of {$gstf})", 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= "\n";
        $printout .= str_pad("Find us online", 42, " ", STR_PAD_BOTH) . "\n\n";
        $printout .= str_pad("kayoh.kitchen", 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= str_pad("facebook.com/kayohkitchen", 42, " ", STR_PAD_BOTH) . "\n";

        return $printout;
    }

    public function lineitem($name, $amount, $unit, $price)
    {
        $printout = '';

        $printout .= $name . "\n";

        $qty_line = "  {$amount} " . ($unit ? $unit . ' ' : '');

        $printout .= $qty_line;
        $printout .= str_pad(' ' . ($price < 0 ? '-' : '') .'$' . number_format(abs($price), 2), 42 - strlen($qty_line), '.', STR_PAD_LEFT);

        $printout .= "\n\n";

        return $printout;

    }
}
