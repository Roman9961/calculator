<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductTranslation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductData extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $product = ( new Product() )
             ->setSlug('vizitki')
             ->setDefaultCount(100)
             ->setDefaultHeight(50)
             ->setDefaultWidth(90)
             ->addPaper($this->getReference('paper.150'))
             ->addPaper($this->getReference('paper.300'))
             ->addPrintType($this->getReference('print.4.0'))
             ->addPrintType($this->getReference('print.4.1'))
             ->addPrintType($this->getReference('print.4.4'))
             ->addPostPrint($this->getReference('post.print.cut'))
             ->addPostPrint($this->getReference('post.print.pack'));
        $product->translate('uk')->setName('Візитки');
        $product->translate('ru')->setName('Визитки');
        $product->mergeNewTranslations();
        $manager->persist($product);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 300;
    }
}
