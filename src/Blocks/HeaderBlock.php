<?php

namespace BrandonJBegle\SlackNotificationChannel\Blocks;

class HeaderBlock
{

    private $content;

    public function content($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get the array representation of the header block.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => 'header',
            'text' => [
                'type' => 'plain_text',
                'text' => $this->content
            ]
        ];
    }
}