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
                ->add('sites','entity',array('class' => 'Gestion\GestionBundle\Entity\Sites',
                                                                'empty_value' => 'Choisir un site',
                                                                'empty_data'  => null))              
                ->add('missionOne','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission',
                                                                'empty_data'  => null))
                ->add('missionTwo','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission',
                                                                'empty_data'  => null))
                ->add('missionThree','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission',
                                                                'empty_data'  => null))
                 ->add('autres','textarea',array('required' => false))
                ->add('detailsMissionOne','text',array('required' => false))
                ->add('detailsMissionTwo','text',array('required' => false))
                ->add('detailsMissionThree','text',array('required' => false))
                ->add('dateLimite','date',array('widget' => 'single_text'))
                ->add('lien','textarea',array('required' => false))
                ->add('niveauUrgence','choice',array('choices' => array ('ordinaire' => 'ordinaire',
                                                                'urgente' => 'urgente'),
                                                                'empty_value' => 'Choisissez un type',
                                                                'empty_data'  => 'ordinaire'))
                 /*->add('etat','choice',array('choices' => array ('Emise' => 'émise',
                                                                'En cour' => 'en cour',
                                                                'Annulée' => 'annulée',
                                                                'Livrée' => 'livrée'),
                                                                'empty_value' => 'Choisissez un état',
                                                                'empty_data'  => 'émise'))*/
                ->add('confidentialite','choice',array('choices' => array ('Normale' => 'Normale',
                                                                            'Haute' => 'Haute'),
                                                                'empty_value' => 'Choisissez un niveau de confidentialité',
                                                                'empty_data'  => 'Normale'))
                ->add('docGdl','text',array('required' => false))
                ->add('envoiePrevuLe','date',array('widget' => 'single_text'),array('required' => false))
                ->add('mettreEnCopie','textarea',array('required' => false))
                        
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
