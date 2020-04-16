<?php
namespace catalogue\linetype;

class vouchercode extends \Linetype
{
    public function __construct()
    {
        $this->table = 'vouchercode';
        $this->label = 'Voucher Code';
        $this->printable = 'true';
        $this->fields = [
            (object) [
                'name' => 'code',
                'type' => 'text',
                'fuse' => 't.code',
            ],
            (object) [
                'name' => 'used',
                'type' => 'text',
                'constrained' => true,
                'fuse' => "if (t.used = 1, 'yes', 'no')",
            ],
            (object) [
                'name' => 'sku',
                'type' => 'text',
                'fuse' => 't.sku',
            ],
            (object) [
                'name' => 'quantity',
                'type' => 'number',
                'fuse' => 't.quantity',
            ],
            (object) [
                'name' => 'nzd',
                'type' => 'number',
                'fuse' => 't.nzd',
            ],
            (object) [
                'name' => 'pickup',
                'type' => 'number',
                'fuse' => 't.pickup',
            ],
        ];

        $this->unfuse_fields = [
            't.code' => ':code',
            't.used' => "if (:used = 'yes', 1, 0)",
            't.sku' => ':sku',
            't.quantity' => ':quantity',
            't.nzd' => ':nzd',
            't.pickup' => ':pickup',
        ];
    }

    public function complete($line)
    {
        if (@$line->used === null) {
            $line->used = 0;
        }
    }

    public function get_suggested_values()
    {
        $suggested_values = [];

        $suggested_values['used'] = ['no', 'yes'];

        return $suggested_values;
    }

    public function validate($line)
    {
        $errors = [];

        if (!$line->code) {
            $errors[] = 'no code';
        }

        if (!$line->sku && !$line->nzd && !$line->pickup) {
            $errors[] = 'please choose an effect for this voucher (sku, nzd, pickup)';
        }

        if ($line->sku && (!$line->quantity || $line->quantity < 0)) {
            $errors[] = 'please specify quantity when specifying sku';
        }

        return $errors;
    }

    public function astext($line, $child_sets)
    {
        $skumetas = get_sku_meta();

        $printout = '';
        $printout .= str_pad("Kayoh Kitchen Voucher", 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= "\n";
        $printout .= str_pad($line->code, 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= "\n";

        $things = [];

        if ($line->sku) {
            $title = @$skumetas[$line->sku]->title ?: $line->sku;
            $things[] = "{$line->quantity} x {$title}";
        }

        if ($line->nzd) {
            $things[] = "\${$line->nzd} off";
        }

        if ($line->pickup) {
            $things[] = "place a pickup order";
        }
        
        $printout .= wordwrap("Entitles the bearer to " . implode(', ', $things), 40) . "\n";

        return $printout;
    }
}
