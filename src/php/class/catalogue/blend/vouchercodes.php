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
                'name' => 'used',
                'type' => 'number',
                'sacrifice' => true,
            ],
            (object) [
                'name' => 'sku',
                'type' => 'text',
                'sacrifice' => true,
            ],
            (object) [
                'name' => 'nzd',
                'type' => 'number',
                'sacrifice' => true,
            ],
            (object) [
                'name' => 'pickup',
                'type' => 'number',
                'sacrifice' => true,
            ],
        ];
    }
}
