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
        $client = new \GuzzleHttp\Client();
        $postApplicantId = $request->postApplicantId;

        $body = "Çatmısansa, indi daxil ol və \"Sifarişə başla\" düyməsini sıx. Ödənişi ala bilmək üçün düyməni sıxmalısan. Uğurlar!🔥";

        $url = 'https://api.adalo.com/notifications';
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 5ckiny17el2vymy81icxgnsbu',
        ];

        $data = [
            'appId' => '0fb25ec4-853d-487d-a48e-bb871341619a',
            'audience' => ['id' => $postApplicantId],
            'notification' => [
                'titleText' => 'Sifarişin 5 dəqiqəyə başlayır ⌛',
                'bodyText' => $body,
            ],
        ];

        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $data,
        ]);
    }
}
