<?php
namespace tablelink;

class skumetacatalogue extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['skumeta', 'skumeta'];
        $this->middle_table = 'record_skumeta';
        $this->ids = [null, null];
        $this->type = 'oneone';
    }
}
