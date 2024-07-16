<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }



    public function save(Request $request)
    {

        Carbon::setLocale('az');

        // Validate incoming data
        $validatedData = $request->validate([
            'UserFullName' => 'required|string',
            'NewDate' => 'required|date',
            'PostTitle' => 'required|string',
            'PostId' => 'required|integer',
            'BusinessName' => 'required|string',
            'UserId' => 'required|integer',
            'BusinessId' => 'required|integer',
            'jobId' => 'required|integer',
        ]);

        // Format the date using Carbon
        $formattedDate = Carbon::parse($validatedData['NewDate'])->isoFormat('D MMMM'); // Using isoFormat for localization

        // Construct notification message
        $notificationMessage = "Təbriklər! 🎉 {$validatedData['BusinessName']} səni {$formattedDate} günü üçün {$validatedData['PostTitle']} vəzifəsi kimi işə qəbul etdi.";

        // Example using Eloquent ORM to save a notification (adjust as per your database structure)
        $post = new Post();
        $post->UserFullName = $validatedData['UserFullName'];
        $post->NewDate = $validatedData['NewDate'];
        $post->PostTitle = $validatedData['PostTitle'];
        $post->PostId = $validatedData['PostId'];
        $post->BusinessName = $validatedData['BusinessName'];
        $post->UserId = $validatedData['UserId'];
        $post->BusinessId = $validatedData['BusinessId'];
        $post->jobId = $validatedData['jobId'];
        $post->message = $notificationMessage; // Ensure 'message' is a field in your 'posts' table or adjust accordingly
        $post->save();

        // Redirect back with the message
        return back()->with('notificationMessage', $notificationMessage);
    }

}
