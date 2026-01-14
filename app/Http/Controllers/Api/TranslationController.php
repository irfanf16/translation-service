<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Repositories\TranslationRepository;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function __construct(
        private TranslationService $service,
        private TranslationRepository $repository
    ) {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string',
            'content' => 'required|string',
            'locale_id' => 'required|exists:locales,id',
            'tags' => 'array'
        ]);

        return response()->json(
            $this->service->create($data),
            201
        );
    }

    public function update(Request $request, Translation $translation)
    {
        $data = $request->validate([
            'key' => 'string',
            'content' => 'string',
            'tags' => 'array'
        ]);

        return response()->json(
            $this->service->update($translation, $data)
        );
    }

    public function show(Translation $translation)
    {
        return $translation->load('locale', 'tags');
    }

    public function search(Request $request)
    {
        return $this->repository->search($request->all());
    }

    public function export(string $locale)
    {
        return cache()->remember(
            "translations:$locale",
            60,
            fn() => Translation::select('key', 'content')
                ->whereHas('locale', fn($q) => $q->where('code', $locale))
                ->get()
                ->pluck('content', 'key')
        );
    }
}
