<?php

namespace Karmek\FaasPhp;

use Symfony\Component\HttpFoundation\Request;

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
