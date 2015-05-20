<?php

namespace Gestion\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class DemandesType extends AbstractType{
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('auNomDe')
                ->add('client')
                ->add('site')
                ->add('adresse')
                ->add('missionOne','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission',
                                                                'empty_data'  => null))
                ->add('missionTwo','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission',
                                                                'empty_data'  => null))
                ->add('missionThree','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission',
                                                                'empty_data'  => null))
                 ->add('autres','textarea')
                ->add('detailsMissionOne')
                ->add('detailsMissionTwo')
                ->add('detailsMissionThree')
                ->add('dateLimite','date')
                ->add('fichiers','collection',array('type' => new FichiersType(),'allow_add' => true,'by_reference' => false,))
                ->add('lien')
                ->add('type','choice',array('choices' => array ('ordinaire' => 'ordinaire',
                                                                'urgente' => 'urgente'),
                                                                'empty_value' => 'Choisissez un type',
                                                                'empty_data'  => 'ordinaire'))
                ->add('avancement','choice',array('choices' => array ('Emise' => 'émise',
                                                                'En cour' => 'en cour',
                                                                'Annulée' => 'annulée',
                                                                'Livrée' => 'livrée'),
                                                                'empty_value' => 'Choisissez un état',
                                                                'empty_data'  => 'émise'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gestion\GestionBundle\Entity\Demandes'
        ));
    }
    
    /**
     * @return string
     */
    public function getName() {
        return 'gestion_gestionbundle_Demandes';
    }
}
