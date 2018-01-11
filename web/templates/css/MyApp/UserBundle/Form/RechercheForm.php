<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 17/11/2017
 * Time: 10:43
 */

namespace MyApp\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('chercher',SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {

    }
    public function getName()
    {
        return 'MyApp_UserBundle_Recherche_form';
    }

}