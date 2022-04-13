<?php

namespace App\Command;

use App\Crawler\MountainProjectCrawler;
use App\Entity\Gym;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:scrap:gym-data',
    description: 'Fetch gyms from MountainProject site.',
)]
class ScrapGymDataCommand extends Command
{
    public function __construct(private readonly MountainProjectCrawler $crawler, private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input,$output);
        $io->info('Fetching Gyms from https://www.mountainproject.com/gym/ ...');
        $gymsData = $this->crawler->fetchGyms();

        $io->success('Gyms fetched ... Processing.');
        foreach ($gymsData as $gymData) {
            $this->entityManager->persist(Gym::fromMPData($gymData));
        }
        $io->info('Flushing gyms into database.');
        try {
            $this->entityManager->flush();
        } catch (\Exception $e) {
            $io->error('An exception has been thrown : ' . $e->getMessage());
            exit(0);
        }

        $io->success('Gyms has been successfully flushed.');


        return Command::SUCCESS;
    }
}
