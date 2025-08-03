<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TranslationRequest;
use App\Models\Translation;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TranslationController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Translation::query();


        if ($request->filled('tag')) {
            $query->where('tag', $request->input('tag'));
        }

        if ($request->filled('key')) {
            $query->where('key', 'like', "%{$request->input('key')}%");
        }

        if ($request->filled('translation')) {
            $query->where('translation', 'like', "%{$request->input('translation')}%");
        }


        $data  = $query->orderBy('id', 'desc')->limit(100)->get();

        return $this->success($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TranslationRequest $request)
    {
        try {
            $translation = Translation::updateOrCreate(
                ['key' => $request->input('key'), 'locale' => $request->input('locale')],
                ['translation' => $request->input('translation'), 'tag' => $request->input('tag')]
            );

            return $this->success($translation, 'Translation saved successfully', 201);
        }
        catch (\Exception $e) {
            return $this->error('Something went wrong while saving translation');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'translation' => 'required|string',
            'tag' => 'nullable|string|max:50',
        ]);

        try {
            $translation = Translation::findOrFail($id);

            $translation->update($request->only(['translation', 'tag']));

            return $this->success($translation, 'Translation updated successfully', 201);
        }
        catch (\Exception $e)
        {
            return $this->error('Something went wrong while updating translation');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $translation = Translation::find($id);

        if (!$translation) {
            return $this->error('Translation not found.', 404);
        }

        $translation->delete();

        return $this->success(null, 'Translation deleted successfully.');
    }

    public function exportTranslations(Request $request, string $locale = null)
    {
        $cacheKey = 'translations_export_' . ($locale ?? 'all');
        $translations = Cache::remember($cacheKey, 60, function () use ($locale) {
            $query = Translation::query();

            if ($locale) {
                $query->where('locale', $locale);
            }

            return $query->select('key', 'translation', 'locale')
                ->get()
                ->groupBy('locale')
                ->map(function ($items) {
                    return $items->mapWithKeys(fn($item) => [$item->key => $item->translation]);
                });
        });

        return $this->success($translations);
    }
}
