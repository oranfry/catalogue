<?php
namespace catalogue\linetype;

class sale extends \Linetype
{
    public function __construct()
    {
        $this->table = 'sale';
        $this->label = 'Sale';
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
}
