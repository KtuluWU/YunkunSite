<?php

namespace YunkunBundle\Form;

use YunkunBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ContactType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact_username', null, array('translation_domain' => 'FOSUserBundle'))
            ->add('contact_email', null, array('translation_domain' => 'FOSUserBundle'))
            ->add('contact_subject', null, array('translation_domain' => 'FOSUserBundle'))
            ->add('contact_message', null, array('translation_domain' => 'FOSUserBundle'));
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Contact::class,
        ));
    }
}