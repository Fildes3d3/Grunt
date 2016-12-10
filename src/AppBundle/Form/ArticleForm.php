<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postCategory', ChoiceType::class, array(
                    'choices' => array(
                        'garaj' => 'garaj',
                        'diy' => 'diy',
                        'jurnal' => 'jurnal',
                    )
                ))
            ->add('postTitle')
            ->add('postData');
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
