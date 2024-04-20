<?php
class Dog extends Omnivores {
    public function __construct()
    {
        echo get_class($this) . ': ' . $this->walk() . '<br/>';
        echo $this->valami . '<br/>';
        //echo $this->valami();
    }

    public function givesBirth()
    {
        return true;
    }

    public function behaviour()
    {
        return 'bark';
    }

    public function getValami2() {
        return $this->valami2();
    }
}