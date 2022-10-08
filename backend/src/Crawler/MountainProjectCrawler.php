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
        $crawler
            ->filter('table a[href^="https://www.mountainproject.com/gym/"]')
            ->each(function (Crawler $node) use (&$gymsData) {
                $gymsData[] = $this->fetchGym($node->attr('href'));
            }
        );

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
        $divCount = $crawler->filter('.gym-info div')->count();

        if ($divCount === 3) {
            $siteUrl = $crawler->filter(".gym-info div:nth-of-type(1)")->children('a')->attr('href');
            $phoneNumber = $crawler->filter(".gym-info div:nth-of-type(2)")->innerText();
            $address = $crawler->filter(".gym-info div:nth-of-type(3)")->children('a')->innerText();
            var_dump($address);
        }

        if ($divCount === 2) {
            $siteUrl = $crawler->filter(".gym-info div:nth-of-type(1)")->children('a')->attr('href');
            $phoneNumber = null;
            $address = $crawler->filter(".gym-info div:nth-of-type(2)")->children('a')->innerText();
            var_dump($address);
        }

        return [
            'mp_id' => $uriTerms[4],
            'slug' => $uriTerms[5],
            'name' => $crawler->filter('h1')->innerText(),
            'address' => $address ?? null,
            'phone_number' => $phoneNumber ?? null,
            'site_url' => $siteUrl ?? null
        ];
    }
}
