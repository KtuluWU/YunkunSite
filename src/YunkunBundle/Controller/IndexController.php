<?php
namespace YunkunBundle\Controller;

use YunkunBundle\Entity\Lang;
use YunkunBundle\Form\ContactType;
use YunkunBundle\Entity\Contact;
use Symfony\Component\Routing\Annotation\Route; /* 路由 */
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
        $blogs = $this->getBlogsArrayFromDB();
        return $this->render('portal/index.html.twig', array(
            'blogs' => $blogs,
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
    public function contactAction(Request $request)
    {   
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $username = $contact->getContactUsername();
            $email = $contact->getContactEmail();
            $subject = $contact->getContactSubject();
            $message_nobr = $contact->getContactMessage();
            $message = nl2br($message_nobr);

            $subject_to_send = "Contact YunKun: ".$subject;

            $mail_to_send = \Swift_Message::newInstance()
                ->setSubject($subject_to_send)
                ->setFrom('noreply@yunkun.org')
                ->setTo('contact@yunkun.org')
                ->setBody(
                    $this->renderView(
                        'email/email_contact.html.twig',array(
                            'user_email' => $email,
                            'user_message' => $message,
                            'user_name' => $username
                    )),
                    'text/html'
                );
            $this->get('mailer')->send($mail_to_send);

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'portal/contact.html.twig', array(
                'form' => $form->createView(),
        ));
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
        date_default_timezone_set("Europe/Paris");
        $arrive_paris_date = strtotime('2013-10-08');
        $now = time();
        $count_date = round(($now - $arrive_paris_date) / (60 * 60 * 24));
        return $this->render(
            'portal/cv.html.twig', array('count_date' => $count_date)
        );
    }

    /**
     * @Route("/Projects", name="projectspage")
     */
    public function projectsAction()
    {
        return $this->render(
            'portal/projects.html.twig'
        );
    }

    /**
     * @return array
     */
    private function getBlogsArrayFromDB()
    {
        $em = $this->getDoctrine()->getManager();
        $blogs_db = $em->getRepository('YunkunBundle:Blog')->findAll();
        $blogs_to_index = array();

        foreach($blogs_db as $blog) {
            array_push($blogs_to_index, array(
                'title'=>$blog->getTitle(), 
                'category'=>$blog->getCategory(),
                'author'=>$blog->getAuthor(),
                'editor'=>$blog->getEditor(),
                'pre_text'=>$blog->getPreText(),
                'pre_html'=>$blog->getPreHtml(),
                'article_text'=>$blog->getArticleText(),
                'article_html'=>$blog->getArticleHtml(),
                'image'=>$blog->getImage(),
                'post_date'=>$blog->getPostDate(),
                'edit_date'=>$blog->getEditDate()
            ));
        }

        return $blogs_to_index;
    }

}
