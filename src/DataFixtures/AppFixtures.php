<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    protected int $accountsCount;
    protected int $teamsCount;

    public function setOptions(array $options): void
    {
        $this->accountsCount = $options['app.accounts_count'] ?? 1000;
        $this->teamsCount = $options['app.teams_count'] ?? 50;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $teams = [];

        for ($t = 1; $t <= $this->teamsCount; $t++) {
            $teams[$t] = new Team();
            $teams[$t]->setName($faker->name);

            $manager->persist($teams[$t]);
        }

        for ($a = 1; $a <= $this->accountsCount; $a++) {
            $account = new Account();
            $account->setName(sprintf('%s %s', $faker->firstName, $faker->lastName));
            $account->setTeam($teams[mt_rand(1, $this->teamsCount)]);

            $manager->persist($account);
        }

        $manager->flush();
    }
}
