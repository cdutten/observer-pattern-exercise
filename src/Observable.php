<?php

namespace Cdutten\Observer;

use Cdutten\Observer\Displays\Observer;

interface Observable
{
    /**
     * Notify the observers of changes.
     *
     * @return void
     */
    public function addObserver(Observer $observer): void;

    /**
     * @param Observer $observer
     * @return Observable
     */
    public function removeObserver(Observer $observer): void;

    /**
     * Get the observable state
     *
     * @return array
     */
    public function getState(): array;
}