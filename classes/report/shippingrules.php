<?php

namespace catalogue\report;

class shippingrules extends \jars\Report
{
    function __construct()
    {
        $this->listen = ['shippingrule'];
        $this->classify = fn ($line) => ['all', 'country--' . (@$line->country ?: 'unknown')];
        $this->sorter = fn ($a, $b) => $a->country <=> $b->country ?: $a->rural <=> $b->rural ?: $a->limit <=> $b->limit;
    }
}
