<?php
namespace catalogue\blend;

class customerledger extends \Blend
{
    public function __construct()
    {
        $this->label = 'Customer Ledger';
        $this->linetypes = ['customerinvoice', 'customertransaction'];
        $this->groupby = 'date';
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
                'derived' => true,
            ],
            (object) [
                'name' => 'date',
                'type' => 'date',
                'groupable' => true,
                'main' => true,
            ],
            (object) [
                'name' => 'amount',
                'type' => 'number',
                'summary' => 'sum',
                'dp' => 2,
            ],
        ];
        $this->past = true;
        $this->cum = true;
        $this->showass = ['list', 'calendar', 'graph', 'summaries'];
    }
}
