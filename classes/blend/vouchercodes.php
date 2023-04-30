<?php
namespace catalogue\blend;

class vouchercodes extends \Blend
{
    public function __construct()
    {
        $this->label = 'Voucher Codes';
        $this->linetypes = ['vouchercode',];
        $this->showass = ['list',];
        $this->printable = true;
        $this->fields = [
            (object) [
                'name' => 'code',
                'type' => 'text',
            ],
            (object) [
                'name' => 'nzd',
                'type' => 'number',
            ],
            (object) [
                'name' => 'notes',
                'type' => 'text',
                'sacrifice' => true,
            ],
       ];
    }
}
