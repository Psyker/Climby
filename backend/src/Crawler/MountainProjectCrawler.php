<?php

namespace App\Crawler;

use Goutte\Client;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class MountainProjectCrawler
{
    private const SITE_URL = "https://www.mountainproject.com/gyms/france";
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(HttpClient::create(['timeout' => 60]));
    }

    public function fetchGyms(): array
    {
        $crawler = $this->client->request('GET', self::SITE_URL);
        $gymsData = [];
        $crawler->filter('table a[href^="https://www.mountainproject.com/gym/"]')->each(function (Crawler $node) use (&$gymsData) {
            $gymsData[] = $this->fetchGym($node->attr('href'));
        });

        return $gymsData;
    }

    #[ArrayShape([
        'mp_id' => "string",
        'slug' => "string",
        'country_name' => "string",
        'name' => "string",
        'address' => "string",
        'phone_number' => "string",
        'site_url' => "string"
    ]
    )] private function fetchGym(string $url): array
    {
        $crawler = $this->client->request('GET', $url);
        $uriTerms = explode('/', $crawler->getUri());

        return [
            'mp_id' => $uriTerms[4] ,
            'slug' => $uriTerms[5],
            'name' => $crawler->filter('h1')->innerText(),
            'address' => $crawler->filter('.gym-info div:nth-of-type(3) a')->innerText(),
            'phone_number' =>  $crawler->filter('.gym-info div:nth-of-type(2)')->innerText(),
            'site_url' =>  $crawler->filter('.gym-info div:nth-of-type(1) a')->innerText()
        ];
    }
}
