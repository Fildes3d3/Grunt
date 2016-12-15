<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class CKeFrom extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->add('data', CKEditorType::class)*/
        $builder->add('data', CKEditorType::class, array(
            'base_path' => 'ckeditor',
            'js_path'   => 'ckeditor/ckeditor.js',

        ))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Test'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_cke_from';
    }
}
