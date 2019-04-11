<?php

namespace App\Tests\Controller;


use App\Entity\Station;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
public function testListOfNotification()
    {
        $client= static::createClient();

        $url=$client->getContainer()->get('router')->generate('admin_list');

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testListOfUnreadNotification()
    {
        $client= static::createClient();

        $url=$client->getContainer()->get('router')->generate('admin_list_unread');

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAddStation()
    {
        $formText='Nowy przystanek na kozielskiej';

        $client=static::createClient();
        $url=$client->getContainer()->get('router')->generate('home_add_station');

        $crawler=$client->request('GET', '/addStation');
        $form=$crawler->selectButton('Wyslij')->form([
            'station[title]'=>3,
            'station[text]'=>$formText
        ]);

        $client->submit($form);
        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $station = $client->getContainer()->get('doctrine')->getRepository(Station::class)->findOneBy([
            'text' => $formText,
        ]);
        $this->assertNotNull($station);

        $this->testViewNotification($station);

    }

    private function testViewNotification($station)
    {
        $client=static::createClient();


        $url=$client->getContainer()->get('router')->generate('home_add_station',['id'=>$station->getId()]);

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());



        $this->assertSame(false, $station->getReaded());

    }



}