<?php

namespace BrandonJBegle\SlackNotificationChannel;

use BrandonJBegle\SlackNotificationChannel\Channels\SlackAppChannel;
use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class SlackAppChannelServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config' => config_path(),
            ], 'slack-app-notification-channel');
        }
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/slack-app-notification-channel.php', 'slack-app-notification-channel');

        Notification::resolved(function (ChannelManager $service) {
            $service->extend(SlackAppChannel::class, function ($app) {
                return new SlackAppChannel();
            });
        });
    }
}