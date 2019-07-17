<?php

namespace App\Form;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ["label"=>"Nom"])
            ->add('biography', null, ["label"=>"Biographie"])
            ->add('picture' , null, ["label"=>"Photographie"])
            ->add('program_id',
                null,
                ['choice_label' => 'name',
                    'label'=> 'Numéros auquels il participe :',
                    'multiple' => true,
                    'expanded' => true,]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
