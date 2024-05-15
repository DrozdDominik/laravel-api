<?php

namespace App\Models;

class Category
{
    public $name;
    public $id;

    public function __construct($name)
    {
        $this->name = $name;
        $this->id = rand(1, 1000);
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
        ];
    }
}