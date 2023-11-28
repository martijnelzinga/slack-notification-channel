<?php

namespace Illuminate\Notifications\Slack\BlockKit\Composites;

use Illuminate\Notifications\Slack\Contracts\ObjectContract;
use Illuminate\Support\Arr;

abstract class ElementObject implements ObjectContract
{

    /**
     * Get the instance as an array.
     */
    public abstract function toArray(): array;
}