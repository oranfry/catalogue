<?php
namespace tablelink;

class salevouchercode extends \Tablelink
{
    public function __construct()
    {
        $this->tables = ['sale', 'vouchercode'];
        $this->middle_table = 'tablelink_sale_vouchercode';
        $this->ids = ['sale', 'vouchercode'];
        $this->type = 'onemany';
    }
}
