<?php
namespace Cdutten\Observer\Displays;

use Cdutten\Observer\Observable;

class CurrentConditionsDisplay implements Observer
{
    /**
     * @var Observable $observable
     */
    private $observable;

    /**
     * @var
     */
    private $state;

    public function __construct(Observable $observable)
    {
        $this->observable = $observable;
    }

    /**
     * Displays the data
     *
     * @todo : this is not generic. Needs a better approach.
     */
    public function display()
    {
        echo 'Temperature: ' . $this->state['temperature'] . PHP_EOL .
            'Humidity: ' . $this->state['humidity'] . PHP_EOL .
            'Pressure: ' . $this->state['pressure'];
    }

    /**
     * Update the data
     */
    public function update(): void
    {
        $this->state = $this->observable->getState();
        $this->display();
    }
}