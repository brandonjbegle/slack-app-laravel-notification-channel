<?php

namespace App\Notifications;

use App\Models\Site;
use BrandonJBegle\SlackNotificationChannel\Blocks\ContextBlock;
use BrandonJBegle\SlackNotificationChannel\Blocks\ContextBlock\ContextBlockImage;
use BrandonJBegle\SlackNotificationChannel\Blocks\ContextBlock\ContextBlockText;
use BrandonJBegle\SlackNotificationChannel\Blocks\HeaderBlock;
use BrandonJBegle\SlackNotificationChannel\Blocks\SectionBlock;
use BrandonJBegle\SlackNotificationChannel\Channels\SlackAppChannel;
use BrandonJBegle\SlackNotificationChannel\Messages\SlackAppMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class HealthStatusChangedNotification extends Notification
{
    use Queueable;

    private $site;
    private $prevStatus;
    private $newStatus;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Site $site, $prevStatus, $newStatus)
    {
        $this->site = $site;
        $this->prevStatus = $prevStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SlackAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * //     * @return SlackAppMessage
     */
    public function toSlackApp($notifiable)
    {
        $now = now()->setTimezone('America/New_York')->toDayDateTimeString();
        return (new SlackAppMessage())
            ->text($this->site->name . " health status changed: {$this->prevStatus} to {$this->newStatus}")
            ->blocks([
                (new HeaderBlock)
                    ->content('Health Status Changed'),
                (new ContextBlock)
                    ->elements([
                        (new ContextBlockImage)->text('text')->url('https://' . $this->site->name . '/favicon.ico'),
                        (new ContextBlockText)->type('plain_text')->content($this->site->name),
                    ]),
                (new SectionBlock)
                    ->text("Status changed from {$this->prevStatus} to {$this->newStatus}")
                    ->fields([
                        [
                            'type' => 'mrkdwn',
                            'text' => "*{$now}*"
                        ],
                    ])
            ]);
    }
}
