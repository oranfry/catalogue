<?php

namespace catalogue\report;

class catalogue extends \jars\Report
{
    function __construct()
    {
        $this->listen = ['catalogueitem'];
        $this->sorter = fn ($a, $b) => $a->sku <=> $b->sku;
    }
}
