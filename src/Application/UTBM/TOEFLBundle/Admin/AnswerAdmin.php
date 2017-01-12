<?php

namespace Application\UTBM\TOEFLBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AnswerAdmin extends Admin
{

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('isTrue')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('General')
            ->add('title')
            ->add('isTrue', null, array('required' => false))
            ->end()

//            ->with('Tags')
//            ->add('tags', 'sonata_type_model', array('expanded' => true, 'multiple' => true))
//            ->end()
//            ->with('Comments')
//            ->add('comments', 'sonata_type_model', array('multiple' => true))
//            ->end()
//            ->with('System Information', array('collapsed' => true))
//            ->add('created_at')
//            ->end()
        ;


    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('isTrue')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

}