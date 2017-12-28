<?php


namespace MyApp\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

       $builder ->add('roles' , ChoiceType:: class, array('label' => 'AS',
        'choices' => array('PASSENGER' => 'ROLE_PASSAGER' ,
            'PILOTE' => 'ROLE_CONDUCTEUR' ),
        'required' => true, 'multiple' => true,));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}