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
     *
     */
    public function testUpdate()
    {


    }

    /**
     *
     */
    public function testDisplay()
    {
        $observable = Mockery::mock(Observable::class);
        $currentConditionDisplay = new CurrentConditionsDisplay($observable);
        $state = InflectionHelper::getPrivateProperty($currentConditionDisplay, "state");
        $state->setValue($currentConditionDisplay, ['temperature' => 20, 'humidity' => 80, 'pressure' => 1000]);
        $this->assertEquals(
            'Temperature: 20' . PHP_EOL . 'Humidity: 80' . PHP_EOL . 'Pressure: 1000',
             $currentConditionDisplay->display());
    }
}
