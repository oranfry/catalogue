<?php

namespace catalogue\linetype;

class catalogueitem extends \jars\Linetype
{
    use \simplefields\traits\SimpleFields;

    public function __construct()
    {
        $this->table = 'catalogueitem';

        $this->simple_string('sku');
        $this->simple_string('title');
        $this->simple_string('description');
        $this->simple_float('price', 2);
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
