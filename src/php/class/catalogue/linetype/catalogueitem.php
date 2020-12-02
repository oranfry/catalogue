<?php
namespace catalogue\linetype;

class catalogueitem extends \Linetype
{
    public function __construct()
    {
        $this->label = 'tag';
        $this->label = 'Catalogue Item';
        $this->table = 'catalogueitem';
        $this->fields = [
            (object) [
                'name' => 'sku',
                'type' => 'text',
                'fuse' => '{t}.sku',
            ],
            (object) [
                'name' => 'title',
                'type' => 'text',
                'fuse' => '{t}.title',
                'sacrifice' => true,
            ],
            (object) [
                "name" => "description",
                "type" => "text",
                'fuse' => '{t}.description',
                'hide' => true,
            ],
            (object) [
                "name" => "price",
                "type" => "number",
                "dp" => 2,
                'fuse' => '{t}.price',
                'hide' => true,
            ],
        ];
        $this->unfuse_fields = [
            '{t}.sku' => (object) [
                'expression' => ':{t}_sku',
                'type' => 'varchar(255)',
            ],
            '{t}.title' => (object) [
                'expression' => ':{t}_title',
                'type' => 'varchar(255)',
            ],
            '{t}.description' => (object) [
                'expression' => ':{t}_description',
                'type' => 'varchar(255)',
            ],
            '{t}.price' => (object) [
                'expression' => ':{t}_price',
                'type' => 'decimal(18, 2)',
            ],
        ];
    }

    public function validate($line)
    {
        $errors = [];

        if ($line->sku == null) {
            $errors[] = 'no sku';
        }

        if ($line->title == null) {
            $errors[] = 'no title';
        }

        if ($line->price == null) {
            $errors[] = 'no price';
        }

        return $errors;
    }
}
