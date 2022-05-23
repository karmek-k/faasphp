<?php

namespace Karmek\FaasPhp;

use Exception;
use Symfony\Component\HttpFoundation\Request;

class Executor
{
    public function execute(Request $req, Invokable $invokable): ExecutionResult
    {
        $res = new ExecutionResult();
        
        try {
            $callResult = $invokable->call($req);
        } catch (Exception $e) {
            $res->error = $e;
            $res->callResult = null;

            // TODO: log this

            return $res;
        }

        $res->error = null;
        $res->callResult = $callResult;

        return $res;
    }
}
