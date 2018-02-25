<?php

namespace Tests\Config;

use Tests\Mock;
use Locaty\Testing\TestCase;

class BasicTest extends TestCase\Basic {

    public function testLoad() {
        Mock\Config\Local::instance()->load([
            'host' => 'test.local',
        ]);

        $this->assertEquals('test.local', Mock\Config\Local::instance()->host());
    }

    public function testLoadMulti() {
        Mock\Config\Local::instance()->loadMulti([
            ['host' => 'test.local'],
            ['host' => 'test2.local'],
        ]);

        $this->assertEquals('test2.local', Mock\Config\Local::instance()->host());
    }
}
