<?php

namespace Tests\Application;

use Locaty\Testing;
use Tests\Mock;

class BasicTest extends Testing\TestCase\Basic {

    /**
     * @runInSeparateProcess
     */
    public function testRun() {
        $app = new Mock\Application\Http();
        $app->setActionName('indexAction');
        ob_start();
        $app->run();
        $result = ob_get_contents();
        ob_end_clean();
        $this->assertEquals('ok', $result);
    }

    public function testHandleError() {
        $app = new Mock\Application\Http();
        $app->setActionName('badAction');
        $this->expectExceptionMessage('Some error');
        $app->run();
    }
}
