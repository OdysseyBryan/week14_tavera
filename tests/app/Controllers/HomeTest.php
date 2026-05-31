<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @internal
 */
final class HomeTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    public function testHomePage(): void
    {
        $result = $this->controller(\App\Controllers\Home::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
        $this->assertSame(200, $result->response()->getStatusCode());
    }
}