<?php

namespace Tests;

use Karmek\FaasPhp\AbstractFunction;
use Karmek\FaasPhp\Invokable;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class ExampleFunctionDefaultName extends AbstractFunction
{
    public function call(Request $request): string|array
    {
        return 'Hello world';
    }
}

class ExampleFunctionCustomName extends ExampleFunctionDefaultName
{
    public function name(): string
    {
        return 'FunkyFunction';
    }
}

class AbstractFunctionTest extends TestCase
{
    private Invokable $fnDefaultName;
    private Invokable $fnCustomName;

    protected function setUp(): void
    {
        $this->fnDefaultName = new ExampleFunctionDefaultName();
        $this->fnCustomName = new ExampleFunctionCustomName();
    }

    public function testDefaultFunctionName(): void
    {
        $this->assertEquals('ExampleFunctionDefaultName', $this->fnDefaultName->name());
    }

    public function testCustomFunctionName(): void
    {
        $this->assertEquals('FunkyFunction', $this->fnCustomName->name());
    }
}
