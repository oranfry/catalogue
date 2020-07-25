<?php
namespace tablelink;

class orderorderitem extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['order', 'orderitem'];
        $this->middle_table = 'tablelink_order_orderitem';
        $this->ids = ['order', 'orderitem'];
        $this->type = 'onemany';
    }
}
