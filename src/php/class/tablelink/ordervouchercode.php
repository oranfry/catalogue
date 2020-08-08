<?php
namespace tablelink;

class ordervouchercode extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['order', 'vouchercode'];
        $this->middle_table = 'tablelink_order_vouchercode';
        $this->ids = ['order', 'vouchercode'];
        $this->type = 'onemany';
    }
}
