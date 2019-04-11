<?php
namespace Mineko\Bus;

use Mineko\Bus\Stubs\NamespaceStub;
use Mineko\Bus\Stubs\NamespaceStubHandler;
use Mineko\Bus\Stubs\SomeOtherSpaceCommandStub;
use Mineko\Bus\Stubs\SomeOtherSpace\SomeOtherHandlerStub;
use PHPUnit\Framework\TestCase;

class NamespaceDispatcherTest extends TestCase
{
    public function testShouldLoadCommandHandlersByConvention()
    {
        $commandStub = new NamespaceStub();
        $expected = true;

        $actual = (new NamespaceDispatcher($this->getContainerMock()))
            ->hasNamespaceCommandHandler($commandStub);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnCommandHandlerFromNamespace()
    {
        $commandStub = new NamespaceStub();
        $containerMock = $this->getContainerMock();

        $expected = 'Mineko\Bus\Stubs\NamespaceStubHandler';

        $containerMock
            ->expects($this->once())
            ->method('make')
            ->with($expected)
            ->will($this->returnValue(new NamespaceStubHandler()));

        $actual = get_class((new NamespaceDispatcher($containerMock))->getCommandHandler($commandStub));

        $this->assertEquals($expected, $actual);
    }

    public function testFallback()
    {
        $expected = 'Mineko\Bus\Stubs\SomeOtherSpace\SomeOtherHandlerStub';
        $containerMock = $this->getContainerMock();
        $containerMock
            ->expects($this->once())
            ->method('make')
            ->with($expected)
            ->will($this->returnValue(new SomeOtherHandlerStub()));

        $testInstance = new NamespaceDispatcher($containerMock);

        // Set mapping to dispatcher
        $testInstance->map([
            'Mineko\Bus\Stubs\SomeOtherSpaceCommandStub' => $expected,
        ]);

        $actual = get_class($testInstance->getCommandHandler(new SomeOtherSpaceCommandStub()));

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return \Illuminate\Contracts\Container\Container
     */
    protected function getContainerMock()
    {
        return $this->createMock(\Illuminate\Contracts\Container\Container::class);
    }
}
