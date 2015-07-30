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
                ->add('categorie','entity',array('class' => 'Gestion\GestionBundle\Entity\Categories',
                                                 'empty_value' => 'Choisir une categorie',
                                                 'empty_data' => NULL,
                                                    'required' => false))
                ->add('potentielFacturation','choice',array('choices' => array ('oui' => 'oui',
                                                                                'non' => 'non'),
                                                                'empty_value' => 'Choisir un potentiel',
                                                                'empty_data'  => 'oui',
                                                            'required' => false))
                ->add('chefDeProjet', 'entity', array('class' => 'Utilisateurs\UtilisateursBundle\Entity\Utilisateurs',
                                                 'empty_value' => 'Choisir un chef de projet',
                                                 'empty_data' => NULL,
                                                 'required' => false))
                ->add('client','entity',array('class' => 'Gestion\GestionBundle\Entity\Clients',
                                                                'empty_value' => 'Choisir un client',
                                                                'empty_data'  => null))
                ->add('sites','entity',array('class' => 'Gestion\GestionBundle\Entity\Sites',
                                                                'empty_value' => 'Choisir un site',
                                                                'empty_data'  => null))              
                ->add('missionOne','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission type',
                                                                'empty_data'  => null,
                                                                'required' => false))
                ->add('missionTwo','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission type',
                                                                'empty_data'  => null,
                                                                'required' => false))
                ->add('missionThree','entity',array('class' => 'Gestion\GestionBundle\Entity\Missions',
                                                                'empty_value' => 'Choisir une mission type',
                                                                'empty_data'  => null,
                                                                'required' => false))
                 ->add('autres','textarea',array('required' => false))
                ->add('detailsMissionOne','text',array('required' => false))
                ->add('detailsMissionTwo','text',array('required' => false))
                ->add('detailsMissionThree','text',array('required' => false))
                //->add('dateLimite','datetime',array('widget' => 'single_text','format' => 'yyyy-MM-dd'))
                ->add('dateLimite', 'text')
                ->add('lien','textarea',array('required' => false))
                ->add('niveauUrgence','choice',array('choices' => array ('ordinaire' => 'Ordinaire',
                                                                'urgente' => 'Urgente',
                                                                             'critique' => 'Critique')))
                 /*->add('etat','choice',array('choices' => array ('Emise' => 'émise',
                                                                'En cour' => 'en cour',
                                                                'Annulée' => 'annulée',
                                                                'Livrée' => 'livrée'),
                                                                'empty_value' => 'Choisissez un état',
                                                                'empty_data'  => 'émise'))*/
                ->add('confidentialite','choice',array('choices' => array ('Normale' => 'Normale',
                                                                            'Haute' => 'Haute')))
                ->add('docGdl','text',array('required' => false))
                ->add('envoiePrevuLe','text')
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
