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

    private int $postApplicantId;

    public function __construct($postApplicantId)
    {
        // Ensure postApplicantId is treated as an integer
        $this->postApplicantId = (int) $postApplicantId;
    }

    public function handle(): void
    {
        // Manual validation, though casting ensures it's already an integer
        if (!is_int($this->postApplicantId)) {
            throw new \InvalidArgumentException('postApplicantId must be an integer');
        }

        $client = new \GuzzleHttp\Client();
        $postApplicantId = $this->postApplicantId;

        $body = "Tester mesajı🔥";

        $url = 'https://api.adalo.com/notifications';
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 5ckiny17el2vymy81icxgnsbu',
        ];

        $data = [
            'appId' => '0fb25ec4-853d-487d-a48e-bb871341619a',
            'audience' => ['id' => $postApplicantId],
            'notification' => [
                'titleText' => 'Test işlədi! ⌛',
                'bodyText' => $body,
            ],
        ];

        $response = $client->post($url, [
            'headers' => $headers,
            'json' => $data,
            'verify' => false, // Disable SSL certificate verification
        ]);

    }
}
