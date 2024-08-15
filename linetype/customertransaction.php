<?php

namespace catalogue\linetype;

class customertransaction extends \Linetype
{
    public function __construct()
    {
        $this->label = 'Customer Transaction';
        $this->icon = 'dollar';
        $this->table = 'customertransaction';
        $this->summaries = null;
        $this->showass = ['list', 'calendar', 'graph'];
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'fuse' => "'dollar'",
                'derived' => true,
            ],
            (object) [
                'name' => 'date',
                'type' => 'date',
                'groupable' => true,
                'fuse' => '{t}.date',
            ],
            (object) [
                'name' => 'amount',
                'type' => 'number',
                'dp' => 2,
                'summary' => 'sum',
                'fuse' => '{t}.amount',
            ],
            (object) [
                'name' => 'tax',
                'type' => 'number',
                'dp' => 2,
                'summary' => 'sum',
                'fuse' => '{t}.tax',
            ],
            (object) [
                'name' => 'net',
                'type' => 'number',
                'dp' => 2,
                'summary' => 'sum',
                'fuse' => 'ifnull({t}.amount, 0) - ifnull({t}.tax, 0)',
            ],
        ];
        $this->unfuse_fields = [
            '{t}.date' => (object) [
                'expression' => ':{t}_date',
                'type' => 'date',
            ],
            '{t}.amount' => (object) [
                'expression' => ':{t}_amount',
                'type' => 'decimal(18, 2)',
            ],
            '{t}.tax' => (object) [
                'expression' => ':{t}_tax',
                'type' => 'decimal(18, 2)',
            ],
        ];
    }

    public function get_suggested_values($token)
    {
        $suggested_values = [];

        $suggested_values['account'] = get_values($token, 'transaction', 'account');

        return $suggested_values;
    }

    public function validate($line): array
    {
        $errors = parent::validate($line);

        if ($line->date == null) {
            $errors[] = 'no date';
        }

        if ($line->amount == null) {
            $errors[] = 'no amount';
        }

        return $errors;
    }
}
