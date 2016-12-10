<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                    'placeholder' => 'Alege categoria in care doresti sa publici ->'
                ))
            ->add('postTitle')
            ->add('postData', TextareaType::class, array(
                'attr' => array(
                    'cols' => '5',
                    'rows' => '10'
                )
            ));
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
