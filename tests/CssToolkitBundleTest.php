<?php

namespace BohnMedia\CssToolkitBundle\Tests;

use BohnMedia\CssToolkitBundle\CssToolkitBundle;
use PHPUnit\Framework\TestCase;

class ContaoHelloWorldBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new CssToolkitBundle();

        $this->assertInstanceOf('BohnMedia\CssToolkitBundle\CssToolkitBundle', $bundle);
    }
}