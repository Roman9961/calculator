<?php

namespace App\DataFixtures;

use App\Entity\Paper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPaperData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $paper150 = ( new Paper() )
             ->setName('меловка')
             ->setPrice(0.05)
             ->setDensity(150)
             ->addCoat( $this->getReference('coat.gloss.25') )
             ->addCoat( $this->getReference('coat.matt.25') )
             ->setType( $this->getReference('paper.coated') );
         $manager->persist($paper150);

        $paper300 = ( new Paper() )
             ->setName('меловка')
             ->setPrice(0.07)
             ->setDensity(300)
             ->addCoat($this->getReference('coat.gloss.25'))
             ->addCoat($this->getReference('coat.matt.25'))
             ->addCoat($this->getReference('coat.gloss.175'))
             ->setType($this->getReference('paper.coated'));
        $manager->persist($paper300);

        $manager->flush();
        $this->addReference('paper.300', $paper300);
        $this->addReference('paper.150', $paper150);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 200;
    }
}
