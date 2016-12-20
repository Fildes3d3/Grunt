<?php

namespace AppBundle\Form;

use Ivory\CKEditorBundle\IvoryCKEditorBundle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('articleCaption', TextType::class, array(
                'label' => 'Descriere Categorie:'
            ))
            ->add('postTitle', TextType::class, array(
                'label' => 'Titlu Articol:'
            ))
           /* ->add('postData', TextareaType::class, array(
                'attr' => array(
                    'cols' => '5',
                    'rows' => '10'
                ),
                'label' => 'Articol... :'
            ))*/
           ->add('postData', CKEditorType::class, array(
               'config' => array(
                   'filebrowserBrowseRoute' => 'elfinder',
                   'filebrowserBrowseRouteParameters' => array(
                       'instance' => 'default',
                       'homeFolder' => ''
                   )
               ),
           ))
            ->add('picture', FileType::class, array(
                'label' => 'Fotografie:',
                'required' => false,
                'data_class' => null,

            ))
            ->add('pictureCaption', TextType::class, array(
                'label' => 'Descriere Fotografie'
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
