<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostThresholdTest extends WebTestCase
{
    public function testPostingThreshold(): void
    {
        $client = self::createClient();
        $json = <<<JSON
{
   "userId":"3c330e7a-f056-4bec-b5c1-7a466f03f885",
   "money":{
      "amount":45678,
      "currency":"EUR"
   }
}
JSON;
        $client->request('POST', 'threshold', [], [], [], $json);
        $this->assertResponseIsSuccessful();
    }

}