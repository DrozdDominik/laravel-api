<?php

namespace App\Models;

class Tag
{
    public $id;
    public $name;

    public function __construct($name, $id)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
        ];
    }
}