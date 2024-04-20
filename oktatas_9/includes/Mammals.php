<?php
// Szintén kötelezően létrehozandó értékeket tartalmazó class abban az esetben, 
// hogy ha az adott érték abstract jellemzővel rendelkezik
abstract class Mammals {
    public $valami = 'nem';
    public abstract function givesBirth();

    public function walk()
    {
        return 'Walks';
    }

    private function valami() {
        return 'valami';
    }

    protected function valami2() {
        return 'valami2';
    }
}
