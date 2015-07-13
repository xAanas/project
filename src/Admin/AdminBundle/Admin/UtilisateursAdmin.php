<?php

namespace Admin\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UtilisateursAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('username')
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('enabled')
            ->add('roles','collection',array(
                                'type'   => 'choice',
                                'options'  => array(
                                'choices'  => array(
                                'ROLE_ADMIN' => 'admin',
                                'ROLE_USER'     => 'utilisateur',
                                'ROLE_COLLABTN'    => 'collaborateur tn',
                                'ROLE_COLLABFR'    => 'collaborateur fr',
        ),
    ),
))
            ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('enabled')
            ->add('roles')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('username')
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('enabled')
            ->add('roles')
        ;
    }
}