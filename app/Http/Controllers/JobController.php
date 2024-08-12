<?php

namespace App\Http\Controllers;

use App\Jobs\ApplicantApprove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    public function sendId(Request $request)
    {
        $request->validate([
            'postApplicantId' => 'required|integer',
        ]);

        $postApplicantId = $request->postApplicantId;

        Log::info('Received postApplicantId: ' . $postApplicantId);

        // Dispatch the job
        ApplicantApprove::dispatch($postApplicantId);

        Log::info('Job dispatched with postApplicantId: ' . $postApplicantId);

        return response()->json(['status' => 'Job dispatched successfully']);
    }
}
