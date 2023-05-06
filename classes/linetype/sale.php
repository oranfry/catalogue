<?php
namespace catalogue\linetype;

class sale extends \Linetype
{
    public function __construct()
    {
        $this->table = 'sale';

        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'piggybank'",
                'derived' => true,
            ],
            (object) [
                'name' => 'date',
                'type' => 'date',
                'fuse' => '{t}.date',
                'main' => true,
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
            (object) [
                'name' => 'currency',
                'type' => 'text',
                'fuse' => '{t}.currency',
            ],
            (object) [
                'name' => 'txid',
                'type' => 'text',
                'fuse' => "{t}.txid",
            ],
            (object)[
                'type' => 'file',
                'name' => 'file',
                'icon' => 'docpdf',
                'path' => 'sale',
                'generable' => true,
            ],
        ];
        $this->unfuse_fields = [
            '{t}.date' => (object) [
                'expression' => ':{t}_date',
                'type' => 'date',
            ],
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
            '{t}.currency' => (object) [
                'expression' => ':{t}_currency',
                'type' => 'char(3)',
            ],
            '{t}.txid' => (object) [
                'expression' => ":{t}_txid",
                'type' => 'varchar(255)',
            ],
        ];
    }

    public function validate($line)
    {
        $errors = [];

        if (@$line->date == null) {
            $errors[] = 'no date';
        }

        return $errors;
    }
}
