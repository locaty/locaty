<?php

namespace Tests\Application;

use Locaty\Testing;
use Tests\Mock;

class TestApplication extends Testing\TestCase\Basic {

    /**
     * @runInSeparateProcess
     */
    public function testRun() {
        $app = new Mock\Application\Http();
        ob_start();
        $app->run();
        $result = ob_get_contents();
        ob_end_clean();
        $this->assertEquals('ok', $result);
    }
}
