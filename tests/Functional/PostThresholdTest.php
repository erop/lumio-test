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
   "userId":"",
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