<?php
namespace catalogue\linetype;

class vouchercode extends \Linetype
{
    public function __construct()
    {
        $this->table = 'vouchercode';
        $this->label = 'Voucher Code';
        $this->printable = 'true';
        $this->fields = [
            (object) [
                'name' => 'code',
                'type' => 'text',
                'fuse' => '{t}.code',
            ],
            (object) [
                'name' => 'nzd',
                'type' => 'number',
                'dp' => 2,
                'fuse' => '{t}.nzd',
            ],
            (object) [
                'name' => 'notes',
                'type' => 'text',
                'fuse' => '{t}.notes',
            ],
        ];

        $this->unfuse_fields = [
            '{t}.code' => (object) [
                'expression' => ':{t}_code',
                'type' => 'varchar(10)',
            ],
            '{t}.nzd' => (object) [
                'expression' => ':{t}_nzd',
                'type' => 'decimal(10,2)',
            ],
            '{t}.notes' => (object) [
                'expression' => ':{t}_notes',
                'type' => 'varchar(255)',
            ],
        ];
    }

    public function validate($line)
    {
        $errors = [];

        if (!@$line->code) {
            $errors[] = 'no code';
        }

        return $errors;
    }

    public function astext($line)
    {
        $skumetas = get_sku_meta();

        $printout = '';
        $printout .= str_pad("Kayoh Kitchen Voucher", 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= "\n";
        $printout .= str_pad($line->code, 42, " ", STR_PAD_BOTH) . "\n";
        $printout .= "\n";
        $printout .= "Entitles the bearer to \${$line->nzd} off\n";

        return $printout;
    }
}
