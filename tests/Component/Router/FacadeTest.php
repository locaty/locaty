<?php

namespace Tests\Component\Router;

use Locaty\Testing;
use Locaty\Component;

class FacadeTest extends Testing\TestCase\Basic {

    public function testGetMatchingRoute() {
        $router = new Component\Router\Facade();
        $match = $router->getMatchingRoute($this->_routes(), '/user/123', 'GET');
        $this->assertEquals(123, $match->params()['user_id']);
        $this->assertEquals('index', $match->name());
    }

    /**
     * @return array
     */
    private function _routes(): array {
        return [
            'index' => ['GET', '/user/[i:user_id]', function() {}],
        ];
    }
}
