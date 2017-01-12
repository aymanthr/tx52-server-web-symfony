<?php

namespace Application\UTBM\TOEFLBundle\Admin;

use Application\UTBM\TOEFLBundle\Entity\Answer;
use Application\UTBM\TOEFLBundle\Entity\Question;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class QuestionAdmin extends Admin
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

            ->add('hint', 'sonata_simple_formatter_type', array(
                'format' => 'markdown',
                'label' => "Texte d'aide",
                'required' => false,
                'attr' => array(
                    'rows' => 7
                )

            ))

            ->add('response', 'sonata_simple_formatter_type', array(
                'format' => 'markdown',
                'label' => "Texte de réponse",
                'required' => false,
                'attr' => array(
                    'rows' => 7
                )
            ))

            ->end()
            ->with('Réponses', array(
                'class' => 'col-md-7',
            ))
            ->add('answers', 'sonata_type_collection', array(
                'label' => false,
            ), array(
                'class' => 'Model:Name',
                'target_entity' => 'Answer',
                'allow_delete' => false,
                'multiple' => true,
                'expanded' => false,
                'admin_code' => 'toefl.admin.answer',
                'edit' => 'inline',
                'inline' => 'table',
            ))
            ->end()

            ->with('Classification', array(
                'class' => 'col-md-7',
            ))
            ->add('tags', 'sonata_type_model_autocomplete', array(
                'property' => 'name',
                'multiple' => 'true',
                'required' => false,
            ))
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

    /**
     * @param Question $question
     * @return Question
     */
    public function prePersist( $question )
    {
        /** @var Answer $answer */
        foreach ($question->getAnswers() as $answer) {
            $answer->setQuestion( $question );
        }

        return $question;
    }


    /**
     * @param Question $question
     * @return Question
     */
    public function preUpdate($question)
    {
        /** @var Answer $answer */
        foreach ($question->getAnswers() as $answer) {
            $answer->setQuestion( $question );
        }
    }


}