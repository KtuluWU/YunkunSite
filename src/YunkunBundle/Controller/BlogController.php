<?php
namespace YunkunBundle\Controller;

use YunkunBundle\Form\BlogType;
use YunkunBundle\Form\BlogEditType;
use YunkunBundle\Form\BlogCommentType;
use YunkunBundle\Entity\Blog;
use YunkunBundle\Entity\BlogComment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; /* 路由 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller; /* 基类 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse; /* Json别忘了声明 */
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Blog controller.
 *
 * @Route("/Blog")
 */

class BlogController extends Controller
{
    /**
     * @Route("/", name="blogpage")
     */
    public function blogsAction(Request $request)
    {
        // $blogs = $this->getBlogsArrayFromDB();

        $em = $this->getDoctrine()->getManager();
        $blogs_db = $em->getRepository('YunkunBundle:Blog')->findBy(array(), array('id' => 'desc'));
        $blogs_paginate = $this->get('knp_paginator')->paginate($blogs_db, $request->query->get('page',1),2);

        return $this->render(
            'blog/index.html.twig', array(
                // 'blogs_to_index' => $blogs,
                'blogs_paginate' =>$blogs_paginate,
            )
        );
    }

    /**
     * @Route("/Blog-detail/{blog_title}", name="blogdetailpage" )
     */
    public function blogdetailAction($blog_title, Request $request)
    {
        $blogComment = new BlogComment();
        $blogs = $this->getBlogsArrayFromDB();

        $em = $this->getDoctrine()->getManager();
        $blog_db = $em->getRepository('YunkunBundle:Blog')->findByTitle($blog_title);
        $blog_comments_db = $em->getRepository('YunkunBundle:BlogComment')->findByTitle($blog_title);

        $form = $this->createForm(BlogCommentType::class, $blogComment);
        $form->handleRequest($request);

        $category = $blog_db[0]->getCategory();
        $article_text = $blog_db[0]->getArticleText();
        $article_html = $blog_db[0]->getArticleHtml();
        $pre_text = $blog_db[0]->getPreText();
        $pre_html = $blog_db[0]->getPreHtml();

        $imageName1 = $blog_db[0]->getImage();
        $imageName2 = $blog_db[0]->getImage2();
        $imageName3 = $blog_db[0]->getImage3();
        $title = $blog_db[0]->getTitle();
        $author = $blog_db[0]->getAuthor();
        $editor = $blog_db[0]->getEditor();
        $post_date = $blog_db[0]->getPostDate();
        $edit_date = $blog_db[0]->getEditDate();

        $commentor_from_db = array();
        $comment_from_db = array();
        $comment_post_date_from_db = array();

        $comment_to_detail = array();

        foreach($blog_comments_db as $value) {
            array_push($comment_to_detail, array(
                'commentor' => $value->getCommentor(),
                'comment' => $value->getComment(),
                'post_date' => $value->getPostDate()
            ));
        }

        if ($form->isSubmitted()) {
            $commentor = $blogComment->getCommentor();
            $comment = $blogComment->getComment();

            date_default_timezone_set("Europe/Paris");
            $comment_post_date = date_create(date('Y-m-d H:i:s'));

            $blogComment->setTitle($title);
            $blogComment->setCommentor($commentor);
            $blogComment->setComment($comment);
            $blogComment->setPostDate($comment_post_date);

            $em2 = $this->getDoctrine()->getManager();
            $em2->persist($blogComment);
            $em2->flush();

            return $this->redirectToRoute('blogdetailpage', array('blog_title' => $title));
        }


        return $this->render('blog/blog-detail.html.twig', array(
            'imageName1' => $imageName1,
            'imageName2' => $imageName2,
            'imageName3' => $imageName3,
            'title' => $title,
            'category' => $category,
            'pre_text' => $pre_text,
            'pre_html' => $pre_html,
            'article_text' => $article_text,
            'article_html' => $article_html,
            'author' => $author,
            'editor' => $editor,
            'post_date' => $post_date,
            'edit_date' => $edit_date,
            'blogs' => $blogs,
            'comment_to_detail' => $comment_to_detail,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/AddBlog", name="addblogpage")
     */
    public function addblogAction(Request $request)
    {
        $blog = new Blog();

        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image1 = $blog->getImage();
            $image2 = $blog->getImage2();
            $image3 = $blog->getImage3();

            $imageName1 = $this->generateUniqueFileName($image1);
            $imageName2 = $this->generateUniqueFileName($image2);
            $imageName3 = $this->generateUniqueFileName($image3);

            $image1->move($this->getParameter('blog_images'),$imageName1);
            $image2->move($this->getParameter('blog_images'),$imageName2);
            $image3->move($this->getParameter('blog_images'),$imageName3);

            date_default_timezone_set("Europe/Paris");
            $post_date = date_create(date('Y-m-d H:i:s'));
            
            $user = $this->getUser();
            $author_firstname = $user->getFirstname();
            $author_lastname = $user->getLastname();
            $author = $author_firstname.' '.$author_lastname;

            $title = $blog->getTitle();
            $category = $blog->getCategory();
            $article_text = $_POST['editormd-markdown-doc'];
            $article_html = $_POST['blog-article-html'];
            $pre_text = $_POST['editormd-markdown-doc-pre'];
            $pre_html = $_POST['blog-article-html-pre'];

            $blog->setTitle($title);
            $blog->setCategory($category);
            $blog->setAuthor($author);
            $blog->setImage($imageName1);
            $blog->setImage2($imageName2);
            $blog->setImage3($imageName3);
            $blog->setPreText($pre_text);
            $blog->setPreHtml($pre_html);
            $blog->setArticleText($article_text);
            $blog->setArticleHtml($article_html);
            $blog->setPostDate($post_date);
            $blog->setEditor($author);
            $blog->setEditDate($post_date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blogdetailpage', array('blog_title' => $title));
        }

        return $this->render('blog/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/Edit/{blog_title}", name="editblogpage")
     */
    public function editblogAction(Request $request, $blog_title=-1)
    {
        $blog = new Blog();
        $form = $this->createForm(BlogEditType::class, $blog);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $blog_db = $em->getRepository('YunkunBundle:Blog')->findByTitle($blog_title);

        date_default_timezone_set("Europe/Paris");
        $edit_date = date_create(date('Y-m-d H:i:s'));

        $category = $blog_db[0]->getCategory();
        $pre_text = $blog_db[0]->getPreText();
        $pre_html = $blog_db[0]->getPreHtml();
        $article_text = $blog_db[0]->getArticleText();
        $article_title = $blog_db[0]->getTitle();

        if ($form->isSubmitted()) {
            
            $user = $this->getUser();
            $editor_firstname = $user->getFirstname();
            $editor_lastname = $user->getLastname();
            $editor = $editor_firstname.' '.$editor_lastname;

            $title = $_POST['blog-title'];
            $category_edit = $_POST['blog-category'];
            $pre_text_edit = $_POST['editormd-markdown-doc-pre'];
            $pre_html_edit = $_POST['blog-article-html-pre'];
            $article_text_edit = $_POST['editormd-markdown-doc'];
            $article_html_edit = $_POST['blog-article-html'];

            $blog_db[0]->setTitle($title);
            $blog_db[0]->setCategory($category_edit);
            $blog_db[0]->setEditor($editor);
            $blog_db[0]->setPreText($pre_text_edit);
            $blog_db[0]->setPreHtml($pre_html_edit);
            $blog_db[0]->setArticleText($article_text_edit);
            $blog_db[0]->setArticleHtml($article_html_edit);
            $blog_db[0]->setEditDate($edit_date);

            $em->flush();

            return $this->redirectToRoute('blogdetailpage', array('blog_title' => $title));
        }

        return $this->render('blog/edit.html.twig', array(
            'form' => $form->createView(),
            'category' => $category,
            'pre_text' => $pre_text,
            'article_text' => $article_text,
            'article_title' => $article_title
        ));
    }

    /**
     * @Route("/DeleteBlog/{blog_title}", name="deleteblogpage")
     */
    public function deleteblogAction(Request $request, $blog_title=-1)
    {
        $fileSystem = new Filesystem();
        $em = $this->getDoctrine()->getManager();
        $blog_db = $em->getRepository('YunkunBundle:Blog')->findByTitle($blog_title);
        $blog_comments_db = $em->getRepository('YunkunBundle:BlogComment')->findByTitle($blog_title);

        $imageName1 = $blog_db[0]->getImage();
        $imageName2 = $blog_db[0]->getImage2();
        $imageName3 = $blog_db[0]->getImage3();

        $image1 = ($this->getParameter('blog_images'))."/".$imageName1;
        $image2 = ($this->getParameter('blog_images'))."/".$imageName2;
        $image3 = ($this->getParameter('blog_images'))."/".$imageName3;

        if (file_exists($image1) && file_exists($image2) && file_exists($image3)) {
            $fileSystem->remove($image1);
            $fileSystem->remove($image2);
            $fileSystem->remove($image3);
        }

        foreach ($blog_comments_db as $value) {
            $em->remove($value);
        }
        
        $em->remove($blog_db[0]);
        $em->flush();
        return $this->redirectToRoute('blogpage');
    }

    /**
     * @return string
     */
    private function generateUniqueFileName($image)
    {
        return md5(uniqid()).'.'.$image->guessExtension();;
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
