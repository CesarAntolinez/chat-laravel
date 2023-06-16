<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function chat_with(User $user): \Illuminate\Http\RedirectResponse
    {
        $chat = auth()->user()
            ->chats()
            ->whereHas('users', fn ($q) => $q->where('users.id', $user->id))
            ->first();

        if (!$chat)
            $chat = Chat::create()->users()->sync([$user->id, auth()->id()]);

        return to_route('chat.show', ['chat' => $chat->id]);
    }


    /**
     * Return chat exists for user
     *
     * @param Chat $chat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Chat $chat): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->authorize('view', $chat);

        return view('chat', compact('chat'));
    }
}
