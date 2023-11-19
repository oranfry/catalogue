<?php

namespace catalogue\report;

class orders extends \jars\Report
{
    function __construct()
    {
        $this->listen = ['order'];
        $this->sorter = fn ($a, $b) => $a->date <=> $b->date;

        $this->classify = fn ($line) => [
            substr($line->date, 0, 4), // year
            substr($line->date, 0, 4) . '/' . substr($line->date, 5, 2), // month
        ];
    }
}
