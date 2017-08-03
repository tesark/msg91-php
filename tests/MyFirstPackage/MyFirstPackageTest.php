<?php
declare(strict_types=1);

namespace MyFirstPackage;

use MyFirstPackage\MyFirstPackage;
use PHPUnit\Framework\TestCase;


class MyFirstPackageTest extends TestCase {
    public function testTrueIsTrue () {
        $test = true;
        $this->assertTrue($test);
    }
}
