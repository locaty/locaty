<?php

namespace Tests\Transfer\Response;

use Locaty\Testing;
use Locaty\Transfer\Response;

class Json extends Testing\TestCase\Basic {

    public function testCreate() {
        $json = new Response\Json(['success' => true]);
        $this->assertEquals('{"success":true}', $json->content());
        $this->assertEquals('application/json', $json->headers()['Content-type']);
    }
}
