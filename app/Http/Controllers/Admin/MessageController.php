<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('messages/Index', [
            'messages' => Message::query()->latest()->paginate(20)->through(fn (Message $m) => [
                'id' => $m->id,
                'name' => $m->name,
                'email' => $m->email,
                'phone' => $m->phone,
                'body' => $m->body,
                'read' => $m->read_at !== null,
                'created_at' => $m->created_at?->translatedFormat('d M Y, H:i'),
            ]),
        ]);
    }

    public function read(Message $message): RedirectResponse
    {
        $message->update(['read_at' => $message->read_at ?? now()]);

        return back();
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Pesan dihapus.']);

        return back();
    }
}
