<?php

namespace App\DataFixtures;

use App\Entity\Coat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCoatData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $coatGloss25 = ( new Coat() )
             ->setName('gloss 25 mkm')
             ->setPrice('0.1');
         $manager->persist($coatGloss25);

        $coatMatt25 = ( new Coat() )
            ->setName('matt 25 mkm')
            ->setPrice('0.11');
        $manager->persist($coatMatt25);

        $coatGloss175 = ( new Coat() )
            ->setName('gloss 175 mkm 2side')
            ->setPrice('0.5');
        $manager->persist($coatGloss175);

        $manager->flush();

        $this->addReference('coat.gloss.25', $coatGloss25);
        $this->addReference('coat.matt.25', $coatMatt25);
        $this->addReference('coat.gloss.175', $coatGloss175);
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
