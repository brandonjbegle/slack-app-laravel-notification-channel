<?php

namespace BrandonJBegle\SlackNotificationChannel\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SlackAppChannel
{

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$channel = $notifiable->routeNotificationFor('slackApp', $notification)) {
            return;
        }
        Log::Info($this->buildPayload($channel, $notification->toSlackApp($notifiable)));
//        Todo: this will need to be without the facade for the package
        return Slack::chatPostMessage($this->buildPayload($channel, $notification->toSlackApp($notifiable)));
    }

    protected function buildPayload($channel, $content)
    {
        $blocks = $this->parseBlocks($content->blocks);

        return [
            'channel' => $channel,
            'text'    => $content->text,
            'blocks'  => json_encode($blocks)
        ];
    }

    protected function parseBlocks($blocks)
    {
        $parsed = [];
        if (count($blocks) > 0) {
            foreach ($blocks as $block) {
                array_push($parsed, $block->toArray());
            }
        }
        return $parsed;
    }
}