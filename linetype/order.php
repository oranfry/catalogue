<?php
namespace catalogue\linetype;

class order extends \Linetype
{
    public function __construct()
    {
        $this->table = 'order';

        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'doc'",
                'derived' => true,
            ],
            (object) [
                'name' => 'name',
                'type' => 'text',
                'fuse' => '{t}.name',
            ],
            (object) [
                'name' => 'email',
                'type' => 'text',
                'fuse' => '{t}.email',
            ],
            (object) [
                'name' => 'street',
                'type' => 'text',
                'fuse' => '{t}.street',
            ],
            (object) [
                'name' => 'suburb',
                'type' => 'text',
                'fuse' => '{t}.suburb',
            ],
            (object) [
                'name' => 'postcode',
                'type' => 'text',
                'fuse' => '{t}.postcode',
            ],
        ];

        $this->unfuse_fields = [
            '{t}.name' => (object) [
                'expression' => ':{t}_name',
                'type' => 'varchar(255)',
            ],
            '{t}.email' => (object) [
                'expression' => ':{t}_email',
                'type' => 'varchar(255)',
            ],
            '{t}.street' => (object) [
                'expression' => ':{t}_street',
                'type' => 'varchar(255)',
            ],
            '{t}.suburb' => (object) [
                'expression' => ':{t}_suburb',
                'type' => 'varchar(255)',
            ],
            '{t}.postcode' => (object) [
                'expression' => ':{t}_postcode',
                'type' => 'char(4)',
            ],
        ];

        $this->children = [
            (object) [
                'label' => 'orderitems',
                'linetype' => 'orderitem',
                'rel' => 'many',
                'parent_link' => 'orderorderitem',
            ],
        ];
    }
}
