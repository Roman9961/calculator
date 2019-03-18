<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('App\Entity\Product')->findAll();

        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/product/{slug}", name="product")
     */
    public function product(Product $product)
    {
        $coats = $this->getDoctrine()->getManager()->getRepository('App\Entity\Coat')->findAll();

        return $this->render('default/product/product.html.twig', [
            'product' => $product,
            'coats' => $coats,
        ]);
    }

}
