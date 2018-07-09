<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('phone', null, array('label' => 'form.phone',
            'translation_domain' => 'Yunkun'));
        $builder->add('firstname', null, array('label' => 'form.firstname',
            'translation_domain' => 'Yunkun'));
        $builder->add('lastname', null, array('label' => 'form.lastname',
            'translation_domain' => 'Yunkun'));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}
