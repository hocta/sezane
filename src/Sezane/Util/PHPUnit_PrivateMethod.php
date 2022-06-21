<?php

declare(strict_types=1);

namespace Sezane\Util;

class PHPUnit_PrivateMethod
{
    /**
     * Get a private or protected method for testing/documentation purposes.
     * How to use for MyClass->foo():
     *      $cls = new MyClass();
     *      $foo = PHPUnitUtil::getPrivateMethod($cls, 'foo');
     *      $foo->invoke($cls, $...);
     * @param object $obj The instantiated instance of your class
     * @param string $name The name of your private/protected method
     * @return mixed The method you asked for
     */
    public static function getPrivateMethod(object $obj, string $name): mixed
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @param object $object
     * @param string $method
     * @param array<mixed> $parameters
     * @return mixed
     * @throws \ReflectionException
     */
    public static function callMethod(object $object, string $method, array $parameters = []): mixed
    {
        try {
            $className = get_class($object);
            $reflection = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            throw new \Exception($e->getMessage());
        }

        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}