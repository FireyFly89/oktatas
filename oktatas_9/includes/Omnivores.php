<?php
// Szintén kötelezően létrehozandó értékeket tartalmazó class abban az esetben, 
// hogy ha az adott érték abstract jellemzővel rendelkezik
abstract class Omnivores extends Mammals implements Animals {
    // Override
    public $valami = 'igen';
    public function food()
    {
        return 'everything';
    }
}
