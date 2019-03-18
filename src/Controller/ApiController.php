<?php

namespace App\Controller;

use App\Entity\Coat;
use App\Entity\Paper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    const PAPER_X = 436;
    const PAPER_Y = 306;

    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return new JsonResponse([
            [
                'id' => 1,
                'author' => 'Chris Colborne',
                'avatarUrl' => 'http://1.gravatar.com/avatar/13dbc56733c2cc66fbc698cdb07fec12',
                'title' => 'Bitter Predation',
                'description' => 'Thirteen thin, round towers …',
            ],
            [
                'id' => 2,
                'author' => 'Louanne Perez',
                'avatarUrl' => 'https://randomuser.me/api/portraits/thumb/women/18.jpg',
                'title' => 'Strangers of the Ambitious',
                'description' => "A huge gate with thick metal doors …",
            ],
            [
                'id' => 3,
                'author' => 'Theodorus Dietvorst',
                'avatarUrl' => 'https://randomuser.me/api/portraits/thumb/men/49.jpg',
                'title' => 'Outsiders of the Mysterious',
                'description' => "Plain fields of a type of grass cover …",
            ],
        ]);
    }

    /**
     * @Route("/api/calculate", name="calculate")
     */
    public function calculate(Request $request)
    {
        try {
           $parameters = $this->prepareParametersFromRequest($request);

           $prices =  $this->preparePrices($parameters);

            $result = $this->calculatePrice($prices);

            $response = ['status'=>'success', 'result'=>$result];

        }catch (\Exception $e){
            $response = ['status'=>'error', 'result'=>$e->getMessage()];
        }

        return new JsonResponse($response);
    }

    private function isCoatedAllowedElseThrowError(Paper $paper, $coat):bool
    {
        if( $coat instanceof Coat ) {

            $coats = $paper->getCoats();

            if (!$coats->contains($coat)) {
                throw new \Exception('this paper not laminating');
            }
        }
        return true;
    }

    private function calculatePrice(array $prices):float
    {
        list($coatPrice, $paperPrice, $printPrice, $postPrint, $samplePrice) = $prices;
        $result = $coatPrice + $paperPrice + $printPrice + $postPrint+ $samplePrice;

        return $result;
    }

    private function getCoatPrice($coat, $sheetsCount)
    {
        if( !$coat instanceof Coat ) {
            return 0;
        }

        $price = $coat->getPrice() * $sheetsCount;

        return $price;
    }

    private function getPoductsOnSheet($sizeX, $sizeY)
    {
        if (!$sizeX || !$sizeY || $sizeX < 10 || $sizeY < 10){
            throw new \Exception('Too small sizes');
        }

        $countX = floor( self::PAPER_X/$sizeX );
        $countY = floor( self::PAPER_Y/$sizeY );

        $count = $countX*$countY;

        $revCountX =  floor( self::PAPER_X/$sizeY );
        $revCountY =  floor( self::PAPER_Y/$sizeX );

        $revCount = $revCountX*$revCountY;

        $result = $count > $revCount ? $count : $revCount;

        if(!$result){
            throw new \Exception('Too big sizes');
        }

        return $result;
    }

    private function getSheetsCount($poductsOnSheet, $count, $sheets)
    {
        return  ceil( $count*$sheets / $poductsOnSheet );
    }

    private function getPaperPrice(Paper $paper, $sheetsCount)
    {
        return $paper->getPrice() * $sheetsCount;
    }

    private function getSamplePrice($parameters)
    {
        list($productId, $paperId, $coatId, $count, $sizeX, $sizeY, $sheets, $sample, $printTypeId) = $parameters;

        if(!$sample){
            return 0;
        }

        $count = $sheets;
        $sheets = 1;
        $sample = 0;

        return $this->calculatePrice($this->preparePrices([$productId, $paperId, $coatId, $count, $sizeX, $sizeY, $sheets, $sample, $printTypeId])) * 2;
    }

    /**
     * @param array $parameters
     * @return array
     */
    private function preparePrices(array $parameters):array
    {
        list($productId, $paperId, $coatId, $count, $sizeX, $sizeY, $sheets, $sample, $printTypeId) = $parameters;

        $em = $this->getDoctrine()->getManager();

        $paper = $em->getRepository('App\Entity\Paper')->findOneBy(['id' => $paperId]);
        $coat = $coatId ? $em->getRepository('App\Entity\Coat')->findOneBy(['id' => $coatId]) : $coatId;

        $poductsOnSheet = $this->getPoductsOnSheet($sizeX, $sizeY);

        $sheetsCount = $this->getSheetsCount($poductsOnSheet, $count, $sheets);

        $samplePrice = $this->getSamplePrice($parameters);

        $paperPrice = $this->getPaperPrice($paper, $sheetsCount);

        $printPrice = $this->getPrintPrice($printTypeId, $sheetsCount);

        $postPrint = $this->getPostPrintPrice($productId, $count);

        $this->isCoatedAllowedElseThrowError($paper, $coat);

        $coatPrice = $this->getCoatPrice($coat, $sheetsCount);

        return array($paperPrice, $coatPrice, $printPrice, $postPrint, $samplePrice);
    }

    private function getPrintPrice($printTypeId, $sheetsCount)
    {
        if(!$printTypeId) {
            return 0;
        }

        $printType = $this->getDoctrine()->getManager()->getRepository('App\Entity\PrintType')->findOneBy(['id' => $printTypeId]);

        $prices = $printType->getPrices();

        $price = $this->getPriceDependsOnCount($prices, $sheetsCount);

        return $price*$sheetsCount;
    }

    /**
     * @param $total
     * @param $prices
     * @return float
     */
    private function getPriceDependsOnCount($prices, $total ):float
    {
        $pricesCount = array_keys($prices);

        $currentPricesCount = current($pricesCount);
        $nextPricesCount = next($pricesCount);
        $currentPrice = current($prices);
        $nextPrice = next($prices);

        reset($pricesCount);
        reset($prices);

        foreach ($prices as $count => $price) {
            if ($count < $total) {
                $currentPrice = $price;
                $currentPricesCount = $count;
                $nextPricesCount = next($pricesCount);
                $nextPrice = next($prices);
            }
        }

        $price =
            ($total - $currentPricesCount) * ($nextPrice - $currentPrice) /
            ($nextPricesCount - $currentPricesCount)
            + $currentPrice;

        if (!$nextPrice || !$nextPricesCount) {
            $price = $currentPrice;
            return $price;
        }
        return $price;
    }

    private function getPostPrintPrice($productId, $count)
    {
        if(!$productId) {
            return 0;
        }

        $product = $this->getDoctrine()->getManager()->getRepository('App\Entity\Product')->findOneBy(['id' => $productId]);

        $postPrints = $product->getPostPrints();
        $price = 0;

        foreach ($postPrints as $postPrint){
            $price +=  $postPrint->getPrice()*$count;
        }


        return $price;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function prepareParametersFromRequest(Request $request):array
    {
        $productId = $request->get('product_id');
        $paperId = $request->get('paper');
        $coatId = $request->get('coat', 0);
        $count = $request->get('count');
        $sizeX = $request->get('sizex');
        $sizeY = $request->get('sizey');
        $sheets = $request->get('sheets');
        $sample = $request->get('sample');
        $printTypeId = $request->get('print_type');
        return array($productId, $paperId, $coatId, $count, $sizeX, $sizeY, $sheets, $sample, $printTypeId);
    }
}
