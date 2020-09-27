<?php
namespace catalogue\linetype;

class sale extends \Linetype
{
    public function __construct()
    {
        $this->table = 'sale';
        $this->label = 'Sale';
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
            '{t}.date' => ':{t}_date',
            '{t}.name' => ':{t}_name',
            '{t}.email' => ':{t}_email',
            '{t}.street' => ':{t}_street',
            '{t}.suburb' => ':{t}_suburb',
            '{t}.postcode' => ':{t}_postcode',
            '{t}.currency' => ':{t}_currency',
            '{t}.txid' => ":{t}_txid",
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
