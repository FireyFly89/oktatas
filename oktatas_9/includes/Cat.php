<?php
class Cat extends Omnivores {
    public function __construct()
    {
        echo get_class($this) . ': ' . $this->walk() . '<br/>';
    }

    public function givesBirth()
    {
        return true;
    }

    public function behaviour()
    {
        return 'purr';
    }

    // Override
    public function walk()
    {
        return 'Slides';
    }
}