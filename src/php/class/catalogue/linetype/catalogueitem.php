<?php
namespace catalogue\linetype;

class catalogueitem extends \stockkeeping\linetype\skumeta
{
    public function __construct()
    {
        parent::__construct();

        $this->label = 'tag';
        $this->label = 'Catalogue Item';
        $this->clauses = ['{t}.price is not null'];
        $this->fields[] = (object) [
            "name" => "price",
            "type" => "number",
            "dp" => 2,
            'fuse' => '{t}.price',
            'hide' => true,
        ];
        $this->unfuse_fields['{t}.price'] = ':{t}_price';
    }

    public function validate($line)
    {
        kayoh_dump($line);
        $errors = parent::validate($line);

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
