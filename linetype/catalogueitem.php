<?php

namespace catalogue\linetype;

class catalogueitem extends \jars\Linetype
{
    use \simplefields\traits\SimpleFields;

    public function __construct()
    {
        parent::__construct();

        $this->table = 'catalogueitem';

        $this->simple_string('sku');
        $this->simple_string('title');
        $this->simple_string('description');
        $this->simple_float('price', 2);

        $this->children = [
            (object) [
                'property' => 'batches',
                'linetype' => 'batch',
                'tablelink' => 'catalogueitem_batch',
                'only_parent' => 'catalogueitem_id',
            ],
        ];
    }

    public function validate($line): array
    {
        $errors = parent::validate($line);

        if (!@$line->sku) {
            $errors[] = 'no sku';
        }

        if (!@$line->title) {
            $errors[] = 'no title';
        }

        if (!@$line->price) {
            $errors[] = 'no price';
        }

        return $errors;
    }
}
