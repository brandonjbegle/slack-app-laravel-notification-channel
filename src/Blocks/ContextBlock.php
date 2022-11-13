<?php

namespace BrandonJBegle\SlackNotificationChannel\Blocks;

class ContextBlock
{
    private $elements;

    public function elements(array $elements)
    {
        $this->elements = $elements;
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
        if (count($this->elements) > 0) {
            foreach ($this->elements as $element) {
                array_push($toArrays, $element->toArray());
            }
        }
        return [
            'type' => 'context',
            'elements' => $toArrays
        ];
    }
}