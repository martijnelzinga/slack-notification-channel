<?php

namespace Illuminate\Notifications\Slack\BlockKit\Blocks;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Notifications\Slack\BlockKit\Composites\TextObject;
use Illuminate\Notifications\Slack\BlockKit\Composites\ElementObject;
use Illuminate\Notifications\Slack\BlockKit\Composites\PlainTextOnlyInputObject;
use Illuminate\Notifications\Slack\BlockKit\Elements\LabelElement;
use Illuminate\Notifications\Slack\Contracts\BlockContract;
use Illuminate\Notifications\Slack\Contracts\ElementContract;
use InvalidArgumentException;
use LogicException;

class InputBlock implements BlockContract
{
    /**
     * A string acting as a unique identifier for a block.
     *
     * If not specified, a block_id will be generated.
     *
     * You can use this block_id when you receive an interaction payload to identify the source of the action.
     */
    protected ?string $blockId = null;

    /**
     * An array of interactive element like text inputs.
     *
     * There is a maximum of 25 elements in each action block.
     *
     * @var \Illuminate\Notifications\Slack\Contracts\ElementContract[]
     */
    protected ?ElementObject $element = null;

    protected ?LabelElement $label = null;


    /**
     * Add a plainText input element to the block.
     */
    public function plainTextInput($text = 'action'): PlainTextOnlyInputObject
    {
        return $this->element = new PlainTextOnlyInputObject($text);
    }

    /** 
     * Add a label to the block.
     */
    public function label($label): self
    {
        $this->label = new LabelElement($label);

        return $this;
    }



    /**
     * Get the instance as an array.
     */
    public function toArray(): array
    {
        if (is_null($this->element)) {
            throw new LogicException('An input section requires at least one element,');
        }


        $optionalFields = array_filter([
            'element' => $this->element?->toArray()
        ]);

        return array_merge([
            'type' => 'input',
            'label' => $this->label?->toArray(),
        ], $optionalFields);
    }
}
