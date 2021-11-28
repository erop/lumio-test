<?php

namespace App\Context\Threshold\Domain;

interface IThresholdRepository
{
    public function save(Threshold $threshold): void;
}