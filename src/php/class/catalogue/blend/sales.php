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
                'name' => 'orderid',
                'type' => 'text',
                'default' => '',
            ],
            (object) [
                'name' => 'name',
                'type' => 'text',
                'default' => '',
            ],
        ];
    }
}
