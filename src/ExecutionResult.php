<?php

namespace Karmek\FaasPhp;

use Exception;

class ExecutionResult
{
    public ?Exception $error;
    public string|array|null $callResult;
}
