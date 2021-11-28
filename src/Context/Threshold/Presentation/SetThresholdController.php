<?php

namespace App\Context\Threshold\Presentation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SetThresholdController extends AbstractController
{
    public function __construct()
    {
    }

    public function __invoke(): Response
    {
        return new Response();
    }
}