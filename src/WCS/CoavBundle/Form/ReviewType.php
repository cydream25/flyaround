<?php

namespace WCS\CoavBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text',TextareaType::class,['attr'=>['label'=>'Description','maxlength'=>250]])
            ->add('publicationDate',DateType::class,['data'=>new \DateTime()])
            ->add('note',IntegerType::class,['attr'=>['label'=>'Note1','min'=>0,'max'=>5]])
            ->add('agreeTerms',CheckboxType::class,array('mapped'=>false))
            ->add('userRated',EntityType::class,[
                'class'=>'WCS\CoavBundle\Entity\User',
                'query_builder'=> function (EntityRepository $er){
                    return $er->createQueryBuilder('u')->orderBy('u.lastName','ASC');
                },
                'choice_label'=>'phoneNumber'
            ])
            //->add('reviewAuthor')
            ->add('save',      SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WCS\CoavBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'wcs_coavbundle_review';
    }

}
