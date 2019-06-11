<?php

namespace Tests\Unit\Observer\Displays;

use Cdutten\Observer\Displays\CurrentConditionsDisplay;
use Cdutten\Observer\Observable;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Helpers\InflectionHelper;

class CurrentConditionsDisplayTest extends TestCase
{

    /**
     * Test the update method
     *
     * @throws \ReflectionException
     *
     * @todo: This needs to be refactor to not test display method
     */
    public function testUpdate()
    {
        $observable = Mockery::mock(Observable::class);
        $observable->shouldReceive('getState')
            ->andReturn(['temperature' => 10, 'humidity' => 60, 'pressure' => 900]);
        $currentConditionDisplay = new CurrentConditionsDisplay($observable);
        $currentConditionDisplay->update();
        $state = InflectionHelper::getPrivateProperty($currentConditionDisplay, 'state');
        $this->assertEquals(
            ['temperature' => 10, 'humidity' => 60, 'pressure' => 900],
            $state->getValue($currentConditionDisplay)
        );
    }

    /**
     * Test the display method
     *
     * @throws \ReflectionException
     */
    public function testDisplay()
    {
        $observable = Mockery::mock(Observable::class);
        $currentConditionDisplay = new CurrentConditionsDisplay($observable);
        $state = InflectionHelper::getPrivateProperty($currentConditionDisplay, "state");
        $state->setValue($currentConditionDisplay, ['temperature' => 20, 'humidity' => 80, 'pressure' => 1000]);
        ob_start();
        $currentConditionDisplay->display();
        $this->assertEquals(
            'Temperature: 20' . PHP_EOL . 'Humidity: 80' . PHP_EOL . 'Pressure: 1000',
            ob_get_clean()
        );
    }
}
