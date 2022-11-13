<?php

namespace BrandonJBegle\SlackNotificationChannel\Blocks;

class SectionBlock
{
    private $fields;

    private $text;

    public function fields(array $fields)
    {
        $this->fields = $fields;
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
        $toArrays = [];
        if (count($this->fields) > 0) {
            foreach ($this->fields as $field) {
                if (is_object($field) && method_exists($field, 'toArray')) {
                    array_push($toArrays, $field->toArray());
                } else {
                    array_push($toArrays, $field);
                }
            }
            return [
                'type'   => 'section',
                'text'   => [
                    'text' => $this->text,
                    'type' => 'mrkdwn'
                ],
                'fields' => $toArrays
            ];
        }
    }
}