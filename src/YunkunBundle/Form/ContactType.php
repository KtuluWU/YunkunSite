<?php

namespace YunkunBundle\Form;

use YunkunBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contact_username', null, array('translation_domain' => 'Yunkun'))
            ->add('contact_email', null, array('translation_domain' => 'Yunkun'))
            ->add('contact_subject', null, array('translation_domain' => 'Yunkun'))
            ->add('contact_message', TextareaType::class, array('translation_domain' => 'Yunkun'));
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Contact::class,
        ));
    }
}