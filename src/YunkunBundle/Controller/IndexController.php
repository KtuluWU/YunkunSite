<?php
namespace YunkunBundle\Controller;

use YunkunBundle\Entity\Lang;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; /* 路由 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller; /* 基类 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; /* Json别忘了声明 */
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\Session;


class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /*$locale = new Lang();

        $form = $this->createFormBuilder($locale)
            ->add('locale', ChoiceType::class, array(
                'choices' => array(
                    '中文' => 'zh_CN',
                    'Français' => 'fr'
                ),
            ))
            ->add('save', SubmitType::class, array('label' => '选择'))
            ->getForm();

        $form->handleRequest($request);
        // $localea = $request->getLocale();
        $localeaa = 'null';
        if ($form->isSubmitted() && $form->isValid()) {

            // ... perform some action, such as saving the locale to the database
            // for example, if locale is a Doctrine entity, save it!
            // 一些操作，比如把任务存到数据库中
            // 例如，如果Tast对象是一个Doctrine entity，存下它！
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($locale);
            // $em->flush();
            // $session = new Session();
            // $session->start();
            
            // $request->setLocale($locale); 
            $localeaa = $request->getLocale();
            // $session->set('_locale', $locale);

            return $this->render('portal/index.html.twig', array(
                'form' => $form->createView(),
                // 'localea' => $localea,
                'localeaa' => $localeaa,
            ));
        }*/
        $localeaa = $request->getLocale();
        return $this->render('portal/index.html.twig', array(
            'localeaa' => $localeaa,
        ));
    }

    /**
     * @Route("/NotFound", name="errorpage")
     */
    public function errorAction()
    {
        return $this->render(
            'portal/error.html.twig'
        );
    }

    /**
     * @Route("/Contact", name="contactpage")
     */
    public function contactAction()
    {
        return $this->render(
            'portal/contact.html.twig'
        );
    }

    /**
     * @Route("/AboutUs", name="aboutuspage")
     */
    public function aboutusAction()
    {
        return $this->render(
            'portal/aboutus.html.twig'
        );
    }

    /**
     * @Route("/CV", name="cvpage")
     */
    public function cvAction()
    {
        return $this->render(
            'portal/cv.html.twig'
        );
    }

    public function newAction(Request $request)
    {
        
    }
}
