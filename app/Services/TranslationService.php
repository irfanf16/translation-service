<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Translation;

class TranslationService
{
    public function create(array $data): Translation
    {
        $translation = Translation::create($data);

        if (!empty($data['tags'])) {
            $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id');
            $translation->tags()->sync($tagIds);
        }

        cache()->forget("translations:{$translation->locale->code}");

        return $translation;
    }

    public function update(Translation $translation, array $data): Translation
    {
        $translation->update($data);

        if (isset($data['tags'])) {
            $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id');
            $translation->tags()->sync($tagIds);
        }

        cache()->forget("translations:{$translation->locale->code}");

        return $translation;
    }
}
