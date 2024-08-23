<?php

namespace catalogue\linetype;

class batch extends \jars\Linetype
{
    use \simplefields\traits\SimpleFields;

    public function __construct()
    {
        parent::__construct();

        $this->table = 'batch';

        $this->simple_int('total', 0);
        $this->simple_int('sold', 0);

        $this->borrow = [
            'remaining' => fn ($line): int => $line->total - $line->sold,
        ];
    }

    public function validate($line): array
    {
        $errors = parent::validate($line);

        if ($line->sold > $line->total) {
            $errors[] = 'negative remaining units is not allowed';
        }

        return $errors;
    }
}