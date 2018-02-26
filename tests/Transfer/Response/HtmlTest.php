<?php

namespace Tests\Transfer\Response;

use Locaty\Testing;
use Locaty\Transfer\Response;

class HtmlTest extends Testing\TestCase\Basic {

    public function testCreate() {
        $json = new Response\Html('<h1>Test!</h1>');
        $this->assertEquals('<h1>Test!</h1>', $json->content());
        $this->assertEquals('text/html', $json->headers()['Content-type']);
    }
}
