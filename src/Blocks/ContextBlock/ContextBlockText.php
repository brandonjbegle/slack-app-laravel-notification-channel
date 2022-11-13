<?php

namespace BrandonJBegle\SlackNotificationChannel\Blocks\ContextBlock;

class ContextBlockText
{
    protected $type;

    protected $content;

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

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
            'type' => $this->type,
            'text' => $this->content
        ];
    }
}