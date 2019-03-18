<?php

namespace App\DataFixtures;

use App\Entity\PrintType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPrintTypeData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $printType_4_0 = ( new PrintType() )
             ->setName('4+0');
        $prices = [
            10 => 0.3,
            50 => 0.25,
            100 => 0.2,
            500 => 0.17,
            1000 =>0.15
        ];
        $printType_4_0->setPrices(json_encode($prices));
        $manager->persist($printType_4_0);

        $printType_4_1 = ( new PrintType() )
             ->setName('4+1');
        $prices = [
            '10' => 0.4,
            '50' => 0.3,
            '100' => 0.25,
            '500' => 0.22,
            '1000' =>0.2
        ];
        $printType_4_1->setPrices(json_encode($prices));
        $manager->persist($printType_4_1);

        $printType_4_4 = ( new PrintType() )
            ->setName('4+4');
        $prices = [
            '10' => 0.5,
            '50' => 0.4,
            '100' => 0.37,
            '500' => 0.32,
            '1000' =>0.28
        ];
        $printType_4_4->setPrices(json_encode($prices));
        $manager->persist($printType_4_4);

        $manager->flush();

        $this->addReference('print.4.0', $printType_4_0);
        $this->addReference('print.4.1', $printType_4_1);
        $this->addReference('print.4.4', $printType_4_4);
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
