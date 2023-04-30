<?php
namespace catalogue\blend;

class sales extends \Blend
{
    public function __construct()
    {
        $this->label = 'Sales';
        $this->linetypes = ['sale',];
        $this->showass = ['list', 'calendar',];
        $this->groupby = 'date';
        $this->printable = true;
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
            ],
            (object) [
                'name' => 'date',
                'type' => 'date',
                'groupable' => true,
                'main' => true,
            ],
            (object) [
                'name' => 'name',
                'type' => 'text',
            ],
            (object) [
                'name' => 'email',
                'type' => 'text',
            ],
        ];
    }
}
