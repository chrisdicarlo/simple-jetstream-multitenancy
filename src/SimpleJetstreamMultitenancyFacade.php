<?php

namespace Chrisdicarlo\SimpleJetstreamMultitenancy;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chrisdicarlo\SimpleJetstreamMultitenancy\SimpleJetstreamMultitenancy
 */
class SimpleJetstreamMultitenancyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'simple-jetstream-multitenancy';
    }
}
