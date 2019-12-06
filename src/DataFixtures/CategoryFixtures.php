<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $CATEGORY = new Category();
        $categoryTab = $CATEGORY::$CATEGORY;

        for($i = 0; $i < count($categoryTab); $i++){
            $category = new Category();
            $category->setName($categoryTab[$i]);
            $this->addReference("category$i", $category);
            $manager->persist($category);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 1;
    }
}
