<?php

namespace App\Http\Controllers\Admin;

use App\Ai\AiException;
use App\Ai\PageAssistant;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\Site;
use App\Support\Themes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssistantController extends Controller
{
    /**
     * The AI's proposal for the page's sections. Nothing is saved.
     */
    public function page(Request $request, Page $page, PageAssistant $assistant): JsonResponse
    {
        $data = $request->validate([
            'request' => ['required', 'string', 'max:2000'],
            'sections' => ['present', 'array', 'max:40'],
            'history' => ['nullable', 'array', 'max:12'],
            'history.*.role' => ['required', 'in:user,assistant'],
            'history.*.content' => ['required', 'string', 'max:4000'],
        ], [], ['request' => 'permintaan']);

        try {
            $result = $assistant->edit($page->title, $request->array('sections'), $data['request'], array_values($data['history'] ?? []));
        } catch (AiException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json($result);
    }

    /**
     * The page rendered with unsaved sections, for the editor's preview.
     */
    public function preview(Request $request, Page $page, Site $site): Response
    {
        $preview = $page->replicate();
        $preview->id = $page->id;
        $preview->sections = PageController::cleanSections($request->array('sections'));

        return response(view('site.page', ['page' => $preview, 'theme' => Themes::current($site)])->render());
    }
}
