<?php
namespace tablelink;

class salestocktransfer extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['sale', 'stocktransfer'];
        $this->middle_table = 'tablelink_sale_stocktransfer';
        $this->ids = ['sale', 'stocktransfer'];
        $this->type = 'onemany';
    }
}
