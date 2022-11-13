# Slack App Notification Channel (WIP)

The first-party Laravel Slack channel only supports the limited Incoming Webhooks integration. This package uses the
Chat Post Message api to send a message to any channel in your workspace as long as you have the Channel ID.

I have also made a Nova 4 package to easily retrieve Slack Channel IDs for use in this package [here](https://github.com/brandonjbegle/nova-4-slack-channel-field)

This package is a WIP. Some Block types are implemented to make it easier to compose messages, but currently only one (
SectionBlock) allows (only, for now) arrays. I have provided an
example Notification [here](./examples/HealthStatusChangedNotification.php)

## Installation

You can install the package in to a Laravel app that uses Nova via composer:

```bash
composer require brandonjbegle/slack-app-laravel-notification-channel
```

Now publish config file:

```shell
php artisan vendor:publish --provider="BrandonJBegle\SlackNotificationChannel\SlackAppChannelServiceProvider"
```

Create a Slack App, install it to your workspace, and retrieve your bot token.
[Complete Instructions Here](./docs/SLACK.md)

Add the key and token to your `.env` file

```shell
SLACK_OAUTH_TOKEN=############################
```

## Usage

### Create a notification 

```php
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


```

### Add Notifiable trait to your model
```php
class Site extends Model
{
    use Notifiable;
```
### Add routeNotificationForSlackApp method to your model
```php
public function routeNotificationForSlackApp()
    {
        // If you use the Nova 4 field, this will get the id of the Channel, otherwise simply return the id
        if ($this->slack_notification_channel) {
            return $this->slack_notification_channel['value'] ?? null ;
        }
        return null;
    }
```