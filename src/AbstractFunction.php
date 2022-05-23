<?php

namespace Karmek\FaasPhp;

abstract class AbstractFunction implements Invokable
{
    /**
     * @inheritdoc
     *
     * By default, class name is the function name (without the namespace).
     */
    public function name(): string
    {
        $namespacedClassTokens = explode('\\', static::class);
        $lastIndex = count($namespacedClassTokens) - 1;

        return $namespacedClassTokens[$lastIndex];
    }
}
