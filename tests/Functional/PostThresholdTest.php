<?php

namespace App\Tests\Functional;

use App\Context\Threshold\Presentation\DTO\ThresholdDTO;
use Money\Currency;
use Money\Money;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostThresholdTest extends WebTestCase
{
    public function testPostingThreshold(): void
    {
        $client = self::createClient();
        $dto = new ThresholdDTO(123, new Money(45678, new Currency('EUR')));
        $client->request('POST', 'threshold', [], [], [], );
    }

}