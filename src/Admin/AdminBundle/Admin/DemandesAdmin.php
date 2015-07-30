<?php

namespace Admin\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DemandesAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('utilisateur')
            ->add('chefDeProjet')
            ->add('auNomDe')
            ->add('client')
            ->add('sites')
            ->add('missionOne')
            ->add('missionTwo')
            ->add('missionThree')
            ->add('dateLimite')
            ->add('jaime')
            ->add('jeNaimePas')
            ->add('niveauUrgence')
            ->add('etat')
            ->add('confidentialite')
            ->add('docGdl')
            ->add('envoiePrevuLe')
            ->add('mettreEnCopie')
            ->add('datePosteDemande')
            ->add('dateDernierMiseAJour')
            ->add('dateLivraison')
            ->add('accueil')
            ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('utilisateur')
            ->add('chefDeProjet')
            ->add('auNomDe')
            ->add('client')
            ->add('sites')
            ->add('missionOne')
            ->add('missionTwo')
            ->add('missionThree')
            ->add('dateLimite')
            ->add('jaime')
            ->add('jeNaimePas')
            ->add('niveauUrgence')
            ->add('etat')
            ->add('confidentialite')
            ->add('docGdl')
            ->add('envoiePrevuLe')
            ->add('mettreEnCopie')
            ->add('datePosteDemande')
            ->add('dateDernierMiseAJour')
            ->add('dateLivraison')
            ->add('accueil')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('utilisateur')
            ->add('chefDeProjet')
            ->add('auNomDe')
            ->add('client')
            ->add('sites')
            ->add('missionOne')
            ->add('missionTwo')
            ->add('missionThree')
            ->add('dateLimite')
            ->add('jaime')
            ->add('jeNaimePas')
            ->add('niveauUrgence')
            ->add('etat')
            ->add('confidentialite')
            ->add('mettreEnCopie')
            ->add('datePosteDemande')
            ->add('dateDernierMiseAJour')
            ->add('dateLivraison')
            ->add('accueil')
        ;
    }
}