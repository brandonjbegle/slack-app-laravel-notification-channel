<?php

namespace BrandonJBegle\SlackNotificationChannel\Blocks\ContextBlock;

class ContextBlockImage
{
    protected $url;
    protected $text;

    public function url($url)
    {
        $this->url = $url;
        return $this;
    }

    public function text($text)
    {
        $this->text = $text;
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
            'type'      => 'image',
            'image_url' => $this->url,
            'alt_text'  => $this->text
        ];
    }
}