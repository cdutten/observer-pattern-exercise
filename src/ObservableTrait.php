<?php

namespace Cdutten\Observer;

use Cdutten\Observer\Displays\Observer;

trait ObservableTrait
{
    /**
     * @var Observer[] $observers
     */
    private $observers = [];

    /**
     * Add an Observer
     *
     * @param Observer $observer
     * @return WeatherData
     */
    public function addObserver(Observer $observer): void
    {
        $this->observers[spl_object_hash($observer)] = $observer;
    }

    /**
     * Remove an Observer
     *
     * @param Observer $observer
     * @return WeatherData
     */
    public function removeObserver(Observer $observer): void
    {
        if (!key_exists(spl_object_hash($observer), $this->observers)) {
            throw new \BadMethodCallException('The observer isn\'t registered');
        }
        unset($this->observers[spl_object_hash($observer)]);
    }

    /**
     * Notifies the Observer of a change
     *
     * @return void
     */
    protected function notifyObservers(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}