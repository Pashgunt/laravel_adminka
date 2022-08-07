<?php

namespace App\ADMIN\Repositories;

use App\Models\Tags;

class TagsRepository
{
    public function checkIssetTag(?string $tagName)
    {
        return Tags::query()->where('tag_value', 'like', "%$tagName%")->get();
    }

    public function addNewTagItem(string $tagName)
    {
        $tagItem = Tags::create([
            'tag_value' => $tagName,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        return $tagItem->id;
    }

    public function getTagIdByTagName(string $tagName)
    {
        return Tags::query()
            ->select('id')
            ->where('tag_value', '=', $tagName)->get();
    }
}
