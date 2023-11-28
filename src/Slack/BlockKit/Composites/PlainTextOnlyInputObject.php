<?php

namespace Illuminate\Notifications\Slack\BlockKit\Composites;

use Illuminate\Notifications\Slack\Contracts\ObjectContract;
use Illuminate\Support\Str;
use InvalidArgumentException;

class PlainTextOnlyInputObject extends ElementObject
{

    /**
     * Indicates whether emojis in a text field should be escaped into the colon emoji format.
     */
    protected ?bool $emoji = null;

    /**
     * Indicates whether the input is multiline.
     */
    protected ?bool $multiline = null;

    /**
     * An identifier for this action.
     *
     * You can use this when you receive an interaction payload to identify the source of the action.
     *
     * Should be unique among all other action_ids in the containing block.
     *
     * Maximum length for this field is 255 characters.
     */
    protected string $actionId;

    /**
     * Create a new plain text only input object instance.
     */
    public function __construct($text)
    {
        $this->id('plain_text_input_' . Str::lower(Str::slug(substr($text, 0, 248))));

    }

    /**
     * Indicate that emojis should be escaped into the colon emoji format.
     */
    public function emoji(): self
    {
        $this->emoji = true;

        return $this;
    }

    /**
     * Indicate that multiline is a thing.
     */
    public function multiline(): self
    {
        $this->multiline = true;

        return $this;
    }

    /**
     * Set the action ID for the button.
     */
    public function id(string $id): self
    {
        if (strlen($id) > 255) {
            throw new InvalidArgumentException('Maximum length for the action_id field is 255 characters.');
        }

        $this->actionId = $id;

        return $this;
    }


    /**
     * Get the instance as an array.
     */
    public function toArray(): array
    {
        $optionalFields = array_filter([
            'emoji' => $this->emoji,
            'multiline' => $this->multiline,
        ]);

        return array_merge([
            'type' => 'plain_text_input',
            'action_id' => $this->actionId,
        ], $optionalFields);
    }
}
