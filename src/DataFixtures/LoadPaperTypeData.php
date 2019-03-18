<?php

namespace App\DataFixtures;

use App\Entity\PaperType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPaperTypeData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $paperCoated = ( new PaperType() )
            ->setName('coated');
         $manager->persist($paperCoated);

        $manager->flush();
        $this->addReference('paper.coated', $paperCoated);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 100;
    }
}
