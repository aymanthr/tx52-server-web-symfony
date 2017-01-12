<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\ClassificationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TagAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('context')
        ;

        if ($this->hasSubject() && $this->getSubject()->getId()) {
            $formMapper->add('slug');
        }

        if (interface_exists('Sonata\MediaBundle\Model\MediaInterface')) {
            $formMapper
                ->add('media', 'sonata_type_model_list',
                    array('required' => false),
                    array(
                        'link_parameters' => array(
                            'provider' => 'sonata.media.provider.image',
                            'context'  => 'sonata_tag',
                        ),
                    )
                );
        }

        $formMapper->add('enabled', null, array('required' => false));
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('enabled')
            ->add('context')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('slug')
            ->add('context')
            ->add('enabled', null, array('editable' => true))
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }





}
