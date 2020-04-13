<?php
namespace blend;

class catalogue extends \Blend
{
    public $label = 'Items';
    public $printable = true;
    public $linetypes = ['catalogueitem'];

    public function __construct()
    {
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
            ],
            (object) [
                'name' => 'sku',
                'type' => 'text',
            ],
            (object) [
                'name' => 'title',
                'type' => 'text',
                'sacrifice' => true,
            ],
            (object) [
                'name' => 'price',
                'type' => 'number',
                'sacrifice' => true,
            ],
        ];
    }
}
