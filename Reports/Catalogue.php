<?php

namespace OranFry\Catalogue\Reports;

class Catalogue extends \OranFry\Jars\Core\Report
{
    function __construct()
    {
        $this->listen = [
            'catalogueitem' => (object) [
                'children' => ['batches'],
            ],
        ];

        $this->sorter = fn ($a, $b) => $a->sku <=> $b->sku;
    }
}
