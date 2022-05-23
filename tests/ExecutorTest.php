<?php

namespace Tests;

use Karmek\FaasPhp\AbstractFunction;
use Karmek\FaasPhp\ExecutionResult;
use Karmek\FaasPhp\Executor;
use Karmek\FaasPhp\Invokable;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ExecutedFunctionString extends AbstractFunction
{
    public function call(Request $request): string|array
    {
        return 'this is a string';
    }
}

class ExecutedFunctionArray extends AbstractFunction
{
    public function call(Request $request): string|array
    {
        return [
            'state' => 'done',
            'result' => [
                'sum' => 123,
                'isEven' => false,
            ],
        ];
    }
}

class ExecutedFunctionError extends AbstractFunction
{
    public function call(Request $request): string|array
    {
        return ['lol'][1337];
    }
}

class ExecutorTest extends TestCase
{
    private Executor $executor;
    private Request $req;

    protected function setUp(): void
    {
        $this->executor = new Executor();
        $this->req = Request::createFromGlobals();
    }

    private function execute(Invokable $invokable): ExecutionResult
    {
        return $this->executor->execute($this->req, $invokable);
    }

    public function testFunctionThatThrowsError(): void
    {
        $res = $this->execute(new ExecutedFunctionError());

        $this->assertNotNull($res->error);
        $this->assertNull($res->callResult);
    }

    public function testFunctionThatReturnsString(): void
    {
        $res = $this->execute(new ExecutedFunctionString());

        $this->assertNull($res->error);
        $this->assertEquals('this is a string', $res->callResult);
    }

    public function testFunctionThatReturnsArray(): void
    {
        $res = $this->execute(new ExecutedFunctionArray());

        $this->assertNull($res->error);
        $this->assertIsArray($res->callResult);
    }
}
