<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url): void
    {
        $client = self::createClient();
        $client->request('GET', $url);

        self::assertResponseIsSuccessful();
    }

    public function urlProvider(): ?\Generator
    {
        yield ['/'];
        #yield ['/admin'];
        yield ['/login'];
        #yield ['/logout'];
        yield ['/imprint'];
        yield ['/feedback'];
    }
}
