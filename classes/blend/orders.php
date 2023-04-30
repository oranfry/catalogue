<?php
namespace catalogue\blend;

class orders extends \Blend
{
    public function __construct()
    {
        $this->label = 'Orders';
        $this->linetypes = ['order',];
        $this->showass = ['list', 'calendar',];
        $this->printable = true;
        $this->fields = [
            (object) [
                'name' => 'icon',
                'type' => 'icon',
            ],
            (object) [
                'name' => 'name',
                'type' => 'text',
            ],
        ];
    }
}
