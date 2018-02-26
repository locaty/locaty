<?php

namespace Tests\Component\Router;

use Locaty\SL;
use Locaty\Testing;

class FacadeTest extends Testing\TestCase\Basic {

    public function testGetMatchingRoute() {
        $match = SL::router()->getMatchingRoute($this->_routes(), '/user/123', 'GET');
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
