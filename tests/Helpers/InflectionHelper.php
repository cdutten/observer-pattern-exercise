<?php

namespace Tests\Helpers;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class InflectionHelper
{

    /**
     * Set a private property value
     *
     * @param object $class
     * @param string $name
     *
     * @return ReflectionProperty
     *
     * @throws ReflectionException
     */
    public static function getPrivateProperty(object $class, string $name): ReflectionProperty
    {
        $reflectionClass = new ReflectionClass(get_class($class));
        $property = $reflectionClass->getProperty($name);
        $property->setAccessible(true);
        return $property;
    }
}