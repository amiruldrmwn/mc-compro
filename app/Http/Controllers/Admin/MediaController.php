<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Image uploads for page sections. Returns the stored path (kept in the section) and its URL.
 */
class MediaController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:png,jpg,jpeg,webp,gif,svg', 'max:5120'],
        ], [], ['file' => 'gambar']);

        $path = $request->file('file')->store('media', 'public');

        if ($path === false) {
            return response()->json(['message' => 'Gambar gagal disimpan, coba lagi.'], 500);
        }

        return response()->json(['path' => $path, 'url' => Storage::disk('public')->url($path)]);
    }
}
