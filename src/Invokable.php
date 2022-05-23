<?php

namespace Karmek\FaasPhp;

use Symfony\Component\HttpFoundation\Request;

/**
 * A class that can be invoked by the system, for example AbstractFunction.
 */
interface Invokable
{
    /**
     * Returns the invokable's name.
     */
    public function name(): string;

    /**
     * The main handler.
     *
     * This method returns either a string or an array,
     * which will be serialized to JSON.
     */
    public function call(Request $request): string|array;
}
