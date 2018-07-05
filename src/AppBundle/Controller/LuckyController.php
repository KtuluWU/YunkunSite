<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route; /* 路由 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller; /* 基类 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse; /* Json别忘了声明 */

/**
 * Lucky controller.
 *
 * @Route("/lucky")
 */

class LuckyController extends Controller
{
    /**
     * @Route("/number/{count}", name="lucky_number", requirements={"count": "\d+"})
     */
    public function numberAction($count = 3)
    {
        $numbers = array();
        for($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);

        return $this->render(
            'test_markdown/number.html.twig',
            array('luckyNumberList' => $numbersList)
        );
    }

    /**
     * @Route("/number/{page}", name="lucky_page")
     * 
     */
    public function pageAction($page)
    {
        return new Response(
            '<html><body>Ha ha ha PAGE !'.$page.' </body></html>'
        );

       /*  return new Response(
            '<html><body>Lucky  numberrrrs: '.$numbersList.'</body></html>'
        ); */
    }

    /**
     * @Route("/api/number")
     */
    public function apiNumberAction() {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        /* return new Response(
            json_encode($data),
            200,
            array('Content-Type' => 'application/json')
        ); */
        return new JsonResponse($data);
    }
}
