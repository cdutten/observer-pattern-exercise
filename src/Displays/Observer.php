<?php

namespace Cdutten\Observer\Displays;

interface Observer
{
    /**
     * Update the data
     */
    public function update(): void;
}