<?php

namespace Tests;

use Locaty\Component;
use Locaty\Exception\NotFound;
use Locaty\SL;
use Locaty\Testing;
use Tests\Mock;

class TestSL extends Testing\AbstractTestCase {

    public function testInject() {
        SL::inject(Component\Router\Facade::class, Mock\Component\Router\Facade::class);
        $route = SL::router()->getMatchingRoute([]);
        $this->assertEquals('test_action', $route->name());

        SL::resetInjections();
        $this->expectException(NotFound::class);
        SL::router()->getMatchingRoute([]);
    }

    public function testResetInjections() {
        SL::resetInjections();
        $this->expectException(\Exception::class);
        SL::inject(Component\Router\Facade::class, Mock\Component\Router\Facade::class);
    }
}
