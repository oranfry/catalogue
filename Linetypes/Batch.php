<?php

namespace OranFry\Catalogue\Linetypes;

use SimpleFields\Traits\SimpleFields;

class Batch extends \OranFry\Jars\Core\Linetype
{
    use SimpleFields;

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