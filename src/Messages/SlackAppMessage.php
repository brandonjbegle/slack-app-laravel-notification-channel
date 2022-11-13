<?php

namespace BrandonJBegle\SlackNotificationChannel\Messages;

class SlackAppMessage
{
    public $text;

    public $blocks;

    public function text($text)
    {
        $this->text = $text;
        return $this;
    }

    public function blocks(array $blocks)
    {
        $this->blocks = $blocks;
        return $this;
    }

    public function iconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;
        return $this;
    }
}