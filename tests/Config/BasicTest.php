<?php

namespace Tests\Config;

use Tests\Mock;
use Locaty\Testing\TestCase;

class BasicTest extends TestCase\Basic {

    public function testLoad() {
        Mock\Config\Local::init([
            'host' => 'test.local',
        ]);

        $this->assertEquals('test.local', Mock\Config\Local::host());
    }
}
