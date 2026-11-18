<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sections\DefaultContent;
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
                'color' => $t['color'],
                'sample_url' => url('/').'?preview_sample='.$key,
                'preview_url' => url('/').'?preview_theme='.$key,
            ])->values(),
            'current' => Themes::current($site),
        ]);
    }

    /**
     * Switches the template. With with_content, the pages are replaced by the template's sample
     * content and the brand colour by the template's own.
     */
    public function update(Request $request, Site $site): RedirectResponse
    {
        $data = $request->validate([
            'theme' => ['required', Rule::in(array_keys(Themes::all()))],
            'with_content' => ['boolean'],
        ]);

        $theme = Themes::all()[$data['theme']];
        $site->put(['theme' => $data['theme']]);

        if ($data['with_content'] ?? false) {
            DefaultContent::install((string) $site->get('site_name'), replace: true, preset: $theme['preset']);
            $site->put(['primary_color' => $theme['color']]);
        }

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Template '.$theme['label'].' dipakai'.(($data['with_content'] ?? false) ? ' beserta isi contohnya.' : '.')]);

        return back();
    }
}
