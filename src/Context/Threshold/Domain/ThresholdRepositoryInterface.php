<?php

namespace App\Context\Threshold\Domain;

interface ThresholdRepositoryInterface
{
    public function save(Threshold $threshold): void;
}