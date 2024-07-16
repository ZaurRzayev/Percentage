<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\UserAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function accept(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Assuming the user acceptance process is done here

        // Send notification
        Notification::send($post->user, new UserAccepted($post));

        return response()->json(['message' => 'User accepted and notified.']);
    }
}
