<?php

namespace Tests\Unit\Observer;

use BadMethodCallException;
use Mockery;
use Cdutten\Observer\Displays\Observer;
use Cdutten\Observer\WeatherData;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Tests\Helpers\InflectionHelper;

/**
 * Class WeatherDataTest
 * @package Unit\Observer
 */
class WeatherDataTest extends TestCase
{

    /**
     * Testing the Pressure getter
     *
     * @throws ReflectionException
     */
    public function testGetState()
    {
        $randomPressure = rand(0, 100);
        $randomTemperature = rand(0, 100);
        $randomHumidity = rand(0, 100);

        $weatherData = new WeatherData();
        $pressure = InflectionHelper::getPrivateProperty($weatherData, 'pressure');
        $pressure->setValue($weatherData, $randomPressure);

        $temperature = InflectionHelper::getPrivateProperty($weatherData, 'temperature');
        $temperature->setValue($weatherData, $randomTemperature);

        $humidity = InflectionHelper::getPrivateProperty($weatherData, 'humidity');
        $humidity->setValue($weatherData, $randomHumidity);

        $state = $weatherData->getState();
        $this->assertIsArray($state);
        $this->assertEquals(
            [
                'Pressure' => $randomPressure,
                'Temperature' => $randomTemperature,
                'Humidity' => $randomHumidity,
            ],
            $state
        );
    }

    /**
     * Test add an Observer
     *
     * @throws ReflectionException
     */
    public function testAddObserver()
    {
        $observer = Mockery::mock(Observer::class);
        $weatherData = new WeatherData();
        $weatherData->addObserver($observer);
        $property = InflectionHelper::getPrivateProperty($weatherData, 'observers');

        $this->assertArrayHasKey(spl_object_hash($observer), $property->getValue($weatherData));
        $this->assertInstanceOf(Observer::class, ($property->getValue($weatherData))[spl_object_hash($observer)]);
    }

    /**
     * Test remove an Observer
     *
     * @throws ReflectionException
     */
    public function testRemoveObserver()
    {
        $observer = Mockery::mock(Observer::class);
        $weatherData = new WeatherData();
        $property = InflectionHelper::getPrivateProperty($weatherData, 'observers');
        $property->setValue($weatherData, [spl_object_hash($observer) => $observer]);

        $this->assertArrayHasKey(spl_object_hash($observer), $property->getValue($weatherData));
        $this->assertInstanceOf(Observer::class, ($property->getValue($weatherData))[spl_object_hash($observer)]);

        $weatherData->removeObserver($observer);

        $this->assertArrayNotHasKey(spl_object_hash($observer), $property->getValue($weatherData));
        $this->assertNull(($property->getValue($weatherData))[spl_object_hash($observer)]);
    }

    /**
     * Test trying to remove a unregistered Observer
     *
     * @expectedException BadMethodCallException
     */
    public function testRemoveUnknownObserver()
    {
        $observer = Mockery::mock(Observer::class);
        $weatherData = new WeatherData();
        $weatherData->removeObserver($observer);
    }
}
