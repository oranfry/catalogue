<?php

namespace catalogue\linetype;

class shippingrule extends \jars\Linetype
{
    use \simplefields\traits\SimpleFields;

    public function __construct()
    {
        $this->table = 'shippingrule';

        $this->simple_string('country');
        $this->simple_boolean('rural');
        $this->simple_int('limit');
        $this->simple_float('price', 2);
    }

    public function validate($line): array
    {
        $errors = parent::validate($line);

        if (!@$line->country) {
            $errors[] = 'no country';
        }

        if (!@$line->price) {
            $errors[] = 'no price';
        }

        return $errors;
    }
}
