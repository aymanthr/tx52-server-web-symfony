<?php

namespace Application\UTBM\TOEFLBundle\Admin;

use Application\UTBM\TOEFLBundle\Entity\Answer;
use Application\UTBM\TOEFLBundle\Entity\Question;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CardAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('Informations générales', array(
                'class' => 'col-md-5',
            ))
                ->add('title')

            ->add('title', 'text', array(
                'required' => true
            ))

            ->add('content', 'sonata_simple_formatter_type', array(
                'format' => 'markdown',
                'label' => "Contenu",
                'required' => false,
                'attr' => array(
                    'rows' => 7
                )
            ))


            ->add('media', 'sonata_type_model_list',
                array('required' => false),
                array(
                    'link_parameters' => array(
                        'provider' => 'sonata.media.provider.image',
                        'context'  => 'toelf_card',
                    ),
                )
            )


            ->end()


            ->with('Classification', array(
                'class' => 'col-md-7',
            ))

            ->add('category', 'sonata_type_model_list', array(), array(
                'link_parameters' => array(
                    'context'      => "toefl",
                    'hide_context' => true,
                    'mode'         => 'tree',
                ),
            ))

            ->add('tags', 'sonata_type_model_autocomplete', array(
                'property' => 'name',
                'multiple' => 'true',
                'required' => false,
            ))
            ->end()

        ;

    }

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
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