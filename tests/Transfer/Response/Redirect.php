<?php

namespace Tests\Transfer\Response;

use Locaty\Testing;
use Locaty\Transfer\Response;

class Redirect extends Testing\TestCase\Basic {

    public function testCreate() {
        $json = new Response\Redirect('http://google.com/');
        $this->assertEquals(null, $json->content());
        $this->assertEquals('http://google.com/', $json->headers()['Location']);
    }
}
