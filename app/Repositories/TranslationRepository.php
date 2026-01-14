<?php

namespace App\Repositories;

use App\Models\Translation;

class TranslationRepository
{
    public function search(array $filters)
    {
        return Translation::query()
            ->select('translations.*')
            ->when($filters['key'] ?? null,
                fn($q, $v) => $q->where('key', 'like', "%{$v}%"))
            ->when($filters['locale'] ?? null,
                fn($q, $v) =>
                    $q->whereHas('locale', fn($l) => $l->where('code', $v))
            )
            ->when($filters['content'] ?? null,
                fn($q, $v) => $q->whereFullText('content', $v))
            ->when($filters['tag'] ?? null,
                fn($q, $v) =>
                    $q->whereHas('tags', fn($t) => $t->where('name', $v))
            )
            ->paginate(50);
    }
}

