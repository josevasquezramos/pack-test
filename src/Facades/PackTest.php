<?php

namespace JoseVasquezRamos\PackTest\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JoseVasquezRamos\PackTest\PackTest
 */
class PackTest extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \JoseVasquezRamos\PackTest\PackTest::class;
    }
}
