<?php
namespace catalogue\linetype;

class orderitem extends \Linetype
{
    public function __construct()
    {
        $this->table = 'orderitem';
        $this->label = 'Order Item';
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'doc'",
                'derived' => true,
            ],
            (object) [
                'name' => 'sku',
                'type' => 'text',
                'fuse' => '{t}.sku',
            ],
            (object) [
                'name' => 'quantity',
                'type' => 'number',
                'fuse' => '{t}.quantity',
            ],
        ];
        $this->unfuse_fields = [
            '{t}.sku' => (object) [
                'expression' => ':{t}_sku',
                'type' => 'varchar(255)',
            ],
            '{t}.quantity' => (object) [
                'expression' => ':{t}_quantity',
                'type' => 'int',
            ],
        ];
    }

    public function validate($line)
    {
        $errors = [];

        if (!$line->sku) {
            $errors[] = 'No Sku';
        }

        // TODO: Do a catalogue lookup

        if ($line->sku != 'twopack') {
            $errors[] = 'Invalid Sku';
        }

        if (!$line->quantity || $line->quantity < 0) {
            $errors[] = 'Invalid Quantity';
        }

        return $errors;
    }
}
