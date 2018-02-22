<?php

namespace Locaty\Testing;

use Locaty\SL;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase {

    public function setUp() {
        SL::allowInjections();
    }

    public function tearDown() {
        SL::resetInjections();
    }
}
