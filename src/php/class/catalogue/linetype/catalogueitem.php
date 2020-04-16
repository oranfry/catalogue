<?php
namespace catalogue\linetype;

class catalogueitem extends \stockkeeping\linetype\skumeta
{
    public function __construct()
    {
        parent::__construct();

        $this->label = 'tag';
        $this->label = 'Catalogue Item';
        $this->clauses = ['catalogue.price is not null'];
        $this->inlinelinks = [
            (object)[
                'tablelink' => 'skumetacatalogue',
                'linetype' => 'skumeta',
                'alias' => 'catalogue',
            ],
        ];
        $this->fields[] = (object) [
            "name" => "price",
            "type" => "number",
            "dp" => 2,
            'fuse' => 'catalogue.price',
            'hide' => true,
        ];
        $this->unfuse_fields['catalogue.price'] = ':price';
    }

    public function validate($line)
    {
        $errors = [];

        if ($line->sku == null) {
            $errors[] = 'no sku';
        }

        if ($line->price == null) {
            $errors[] = 'no price';
        }

        return $errors;
    }

    public function has($line, $assoc)
    {
        return $assoc == 'catalogue';
    }
}
