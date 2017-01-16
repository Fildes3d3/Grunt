<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class ArticleForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postCategory', ChoiceType::class, array(
                    'choices' => array(
                        'Public in categoria GARAJ' => 'garaj',
                        'Public in categoria DIY' => 'diy',
                        'Public in categoria JURNAL' => 'jurnal',
                    ),
                    'label' => 'Categorie Articol:',
                    'placeholder' => 'Alege categoria in care doresti sa publici ->'
                ))
            ->add('postTitle', TextType::class, array(
                'label' => 'Titlu Articol:'
            ))
           ->add('postData', CKEditorType::class, array(
               'base_path' => 'ckeditor',
               'js_path'   => 'ckeditor/ckeditor.js',
               'config' => array(
                   'filebrowserBrowseRoute' => 'elfinder',
                   'filebrowserBrowseRouteParameters' => array(
                       'instance' => 'default',
                       'homeFolder' => ''
                   )
               ),
           ))
            ->add('articleDate', DateType::class , array(
                'data' => new \DateTime('now')
            ))
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Article'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_article_form';
    }
}
