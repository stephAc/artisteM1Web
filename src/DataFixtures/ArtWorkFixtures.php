<?php

namespace App\DataFixtures;

use App\Entity\ArtWork;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class ArtWorkFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('fr_FR');
        $CATEGORY = new Category();
        $categoryTab = $CATEGORY::$CATEGORY;

        for ($i = 0; $i < 20; $i++) {

            $artwork = new Artwork();
            $artwork
                ->setName($faker->unique()->sentence(3))
                ->setDescription($faker->text)
                ->setImage($faker->image('public/img/artwork/', 800, 450, null, false));

            try {

                $randomIndexCategory = random_int(0, count($categoryTab) - 1);
            } catch (\Exception $e) {
                print($e);
            }

            $artwork->setCategory($this->getReference("category$randomIndexCategory"));

            $manager->persist($artwork);
        }
        $manager->flush();
    }


    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 2;
    }
}
