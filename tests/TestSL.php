<?php

namespace Tests;

use Locaty\Component;
use Locaty\Exception\NotFound;
use Locaty\SL;
use Locaty\Testing;
use Tests\Mock;

class TestSL extends Testing\AbstractTestCase {

    public function testRouterInstantiation() {
        $this->expectException(NotFound::class);
        SL::router()->getMatchingRoute([]);
    }

    public function testRouterInjection() {
        SL::inject(Component\Router\Facade::class, Mock\Component\Router\Facade::class);
        $route = SL::router()->getMatchingRoute([]);
        $this->assertEquals('testAction', $route->name());
    }
}
