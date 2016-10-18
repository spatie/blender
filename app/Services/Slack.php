<?php

namespace App\Services;

use Illuminate\Notifications\Messages\SlackMessage;

class Slack extends SlackWebhookChannel
{
    public function send(string $webhookUrl, SlackMessage $message)
    {
        $this->http->post($webhookUrl, $this->buildJsonPayload($message));
    }
}
