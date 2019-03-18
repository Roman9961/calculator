<?php

namespace App\DataFixtures;

use App\Entity\PostPrint;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostPrintData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $postPrintCut = (new PostPrint())
            ->setName('порезка гильотина')
            ->setPrice(0.001);

        $manager->persist($postPrintCut);

        $postPrintPack = (new PostPrint())
            ->setName('упаковка для визиток')
            ->setPrice(0.002);

        $manager->persist($postPrintPack);

        $manager->flush();

        $this->addReference('post.print.cut', $postPrintCut);
        $this->addReference('post.print.pack', $postPrintPack);
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
