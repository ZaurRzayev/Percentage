<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApplicantApprove implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $postApplicantId;

    public function __construct($postApplicantId)
    {
        $this->postApplicantId = $postApplicantId;
    }

    public function handle(): void
    {
        try {
            Log::info('ApplicantApprove Job Started with ID: ' . $this->postApplicantId);

            $url = 'https://api.adalo.com/notifications';
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer 5ckiny17el2vymy81icxgnsbu',
            ];

            $data = [
                'appId' => '0fb25ec4-853d-487d-a48e-bb871341619a',
                'audience' => [
                    ['id' => $this->postApplicantId]
                ],
                'notification' => [
                    'titleText' => 'Test Notification🎅',
                    'bodyText' => 'Testing is 🎶🎶',
                ],
            ];

            Log::info('Payload for Adalo API: ' . json_encode($data));

            $response = Http::withHeaders($headers)->post($url, $data);

            Log::info('Adalo API Response Status: ' . $response->status());
            Log::info('Adalo API Response Body: ' . $response->body());

            if ($response->failed()) {
                Log::error('Adalo API Request Failed: ' . $response->body());
            }
        } catch (\Exception $exception) {
            Log::error('ApplicantApprove Job Failed: ' . $exception->getMessage());
        }
    }

}
