<?php

namespace App\Models;

class Pet
{
    public $id;
    public $name;
    public $status;
    public $photoUrls;
    public $tags;
    public $category;

    public function __construct(array $data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        if (!isset($data['name']) || !isset($data['photoUrls'])) {
            throw new \InvalidArgumentException('Name and photoUrls are required');
        }

        $this->name = $data['name'];
        $this->photoUrls = $data['photoUrls'];

        if (isset($data['status'])) {
            $this->status = $data['status'];
        }

        if (isset($data['tags'])) {
            $this->tags = array_map(function($tagName, $index) {
                return new Tag($tagName, $index);
            }, $data['tags'], array_keys($data['tags']));
        }

        if (isset($data['category'])) {
            $this->category = new Category($data['category']);
        }
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
            'photoUrls' => $this->photoUrls,
            'tags' => array_map(function($tag) {
                return $tag->toArray();
            }, $this->tags),
            'category' => $this->category->toArray(),
        ];
    }
}