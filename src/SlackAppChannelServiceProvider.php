<?php

namespace BrandonJBegle\SlackNotificationChannel;

use BrandonJBegle\SlackNotificationChannel\Channels\SlackAppChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class SlackAppChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend(SlackAppChannel::class, function ($app) {
                return new SlackAppChannel();
            });
        });
    }
}