<?php
namespace tablelink;

class saletransaction extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['sale', 'transaction'];
        $this->middle_table = 'tablelink_sale_transaction';
        $this->ids = ['sale', 'transaction'];
        $this->type = 'onemany';
    }
}
