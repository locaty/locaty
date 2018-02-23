<?php

namespace Tests\Application;

use Locaty\Testing\AbstractTestCase;
use Tests\Mock;

class TestApplication extends AbstractTestCase {

    /**
     * @runInSeparateProcess
     */
    public function testRun() {
        $app = new Mock\Application\HttpApplication();
        ob_start();
        $app->run();
        $result = ob_get_contents();
        ob_end_clean();
        $this->assertEquals('ok', $result);
    }
}
