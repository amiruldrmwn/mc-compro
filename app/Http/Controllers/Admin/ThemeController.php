<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ThemeController extends Controller
{
    public function index(Site $site): Response
    {
        return Inertia::render('themes/Index', [
            'themes' => collect(Themes::all())->map(fn (array $t, string $key) => [
                'key' => $key,
                'label' => $t['label'],
                'description' => $t['description'],
                'preview_url' => url('/').'?preview_theme='.$key,
            ])->values(),
            'current' => Themes::current($site),
        ]);
    }

    public function update(Request $request, Site $site): RedirectResponse
    {
        $data = $request->validate(['theme' => ['required', Rule::in(array_keys(Themes::all()))]]);

        $site->put(['theme' => $data['theme']]);
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Template '.Themes::all()[$data['theme']]['label'].' dipakai.']);

        return back();
    }
}
