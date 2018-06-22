<?php

namespace YunkunBundle\Form;

use YunkunBundle\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BlogType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'form.blog.title', 'translation_domain' => 'FOSUserBundle'))
            // ->add('article_text', null, array('label' => 'form.blog.article', 'translation_domain' => 'FOSUserBundle'))
            ->add('category', null, array('label' => 'form.blog.category', 'translation_domain' => 'FOSUserBundle'))
            ->add('image', FileType::class, array('label' => 'form.blog.image1', 'translation_domain' => 'FOSUserBundle'))
            ->add('image_2', FileType::class, array('label' => 'form.blog.image2', 'translation_domain' => 'FOSUserBundle'))
            ->add('image_3', FileType::class, array('label' => 'form.blog.image3', 'translation_domain' => 'FOSUserBundle'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Blog::class,
        ));
    }
}