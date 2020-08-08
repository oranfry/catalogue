<?php
namespace catalogue\linetype;

class order extends \Linetype
{
    public function __construct()
    {
        $this->table = 'order';
        $this->label = 'Order';
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
            '{t}.name' => ':{t}_name',
            '{t}.email' => ':{t}_email',
            '{t}.street' => ':{t}_street',
            '{t}.suburb' => ':{t}_suburb',
            '{t}.postcode' => ':{t}_postcode',
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

    public function validate($line)
    {
        $errors = [];

        return $errors;
    }
}
