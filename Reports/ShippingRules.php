<?php

namespace OranFry\Catalogue\Reports;

class ShippingRules extends \OranFry\Jars\Core\Report
{
    function __construct()
    {
        $this->listen = ['shippingrule'];
        $this->classify = fn ($line) => ['', 'by-country/' . (@$line->country ?: 'unknown')];
        $this->sorter = fn ($a, $b) => $a->country <=> $b->country ?: $a->rural <=> $b->rural ?: $a->limit <=> $b->limit;
    }
}
