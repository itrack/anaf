<?php
namespace Itrack\Anaf;

use PHPUnit\Framework\TestCase as BaseTestCase;
use ReflectionException;
use ReflectionMethod;

class TestCase extends BaseTestCase
{
    /**
     * @return Client
     */
    protected function getInstance()
    {
        return new Client();
    }
}
