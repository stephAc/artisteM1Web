<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Exhibition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class ExhibitionFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('fr_FR');
        $CATEGORY = new Category();
        $categoryTab = $CATEGORY::$CATEGORY;

        for ($i = 0; $i < 20; $i++) {

            $exhibition = new Exhibition();
            $exhibition
                ->setName($faker->unique()->sentence(3))
                ->setDescription($faker->text)
                ->setExhibitionDate($faker->dateTimeBetween($startDate = '-30 days', $endDate = '+30 days', $timezone = null));

            $manager->persist($exhibition);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 0;
    }
}
