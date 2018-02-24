<?php

namespace Locaty\Testing\TestCase;

use Locaty\SL;
use PHPUnit\Framework\TestCase;

abstract class Basic extends TestCase {

    public function setUp() {
        SL::allowInjections();
    }

    public function tearDown() {
        SL::resetInjections();
    }
}
