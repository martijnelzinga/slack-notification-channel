<?php

namespace Illuminate\Notifications\Slack\BlockKit\Elements;

use Closure;
use Illuminate\Notifications\Slack\Contracts\ElementContract;
use Illuminate\Notifications\Slack\BlockKit\Composites\LabelObject;
use Illuminate\Support\Str;
use InvalidArgumentException;

class LabelElement implements ElementContract
{
    /**
     * A text object that defines the label.
     *
     * Can only be of type: plain_text. Text may truncate with ~30 characters.
     *
     * Maximum length for the text in this field is 75 characters.
     */
    protected LabelObject $label;






    /**
     * Create a new button element instance.
     */
    public function __construct(string $label, Closure $callback = null)
    {
        $this->label = new LabelObject($label, 75);

        if ($callback) {
            $callback($this->label);
        }
    }


    /**
     * Get the instance as an array.
     */
    public function toArray(): array
    {
        return $this->label->toArray();
    }
}
