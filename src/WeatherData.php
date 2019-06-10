<?php

namespace Cdutten\Observer;

/**
 * Class WeatherData
 *
 * @package Observer
 */
class WeatherData implements Observable
{
    use ObservableTrait;

    /**
     * @var int $temperature
     */
    private $temperature;

    /**
     * @var int $humidity
     */
    private $humidity;

    /**
     * @var int $pressure
     */
    private $pressure;

    /**
     * Temperature setter
     *
     * @param int $temperature
     */
    public function setTemperature(int $temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * Humidity setter
     *
     * @param int $humidity
     */
    public function setHumidity(int $humidity): void
    {
        $this->humidity = $humidity;
    }


    /**
     * Pressure setter
     *
     * @param int $pressure
     */
    public function setPressure(int $pressure): void
    {
        $this->pressure = $pressure;
    }


    /**
     * Fire events from measurements changed
     */
    public function measurementsChanged(): void
    {
        $this->notifyObservers();
    }


    /**
     * Get the observable state
     *
     * @return array
     */
    public function getState(): array
    {
        return [
            'Pressure' => $this->pressure,
            'Humidity' => $this->humidity,
            'Temperature' => $this->temperature,
        ];
    }


}
