<?php

namespace Application\UTBM\APIBundle\Controller;

use Application\Sonata\ClassificationBundle\Entity\Tag;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

class QuizController extends FOSRestController
{

    /**
     * Fetching quiz list from HTTP request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listQuestionsAction( Request $request )
    {
        // Setting the limit param
        $limit = $request->query->get( 'limit', 10 );

        // Setting the tags filter
        $arrTags = json_decode( $request->query->get( 'tags', "[]" ) );

        // Throwing an exception if the 'tags' parameter is not an array
        if( !is_array( $arrTags ) ) {
            throw new InvalidArgumentException( "The 'tags' parameter must be an array" );
        }

        // Getting questions repository
        $questionRepository = $this->getDoctrine()->getRepository( "ApplicationUTBMTOEFLBundle:Question" );

        $arrQuestions = $questionRepository->findAllQuestionByTags( $arrTags, $limit );

        $view = $this->view( $arrQuestions, 200 );

//        $context = new SerializationContext();
//        $context->setAttribute('image_formats', array('wide'));
//        $view->setSerializationContext($context);

        return $this->handleView(
            $view
        );
    }

    /**
     * Fetching quiz tags list from HTTP request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listTagsAction( Request $request )
    {
        $tagRepository      = $this->getDoctrine()->getRepository( "ApplicationSonataClassificationBundle:Tag");
        $questionRepository = $this->getDoctrine()->getRepository( "ApplicationUTBMTOEFLBundle:Question");

        $arrTags = $tagRepository->findBy( array(
            "context" => "toefl",
            "enabled" => true
        ));

        // Transforming tags in array
        $arrTagsHashes = array();

        /** @var Tag $tag */
        foreach($arrTags as $tag) {

            $intQuestionCount = $questionRepository->getTagQuestionCount( $tag );

            $arrTagsHashes[] = array(
                'id'                => $tag->getId(),
                'name'              => $tag->getName(),
                'media'             => $tag->getMedia(),
                'questions_count'   => $intQuestionCount
            );
        }

        $view = $this->view( $arrTagsHashes, 200 );

        $context = new SerializationContext();
        $context->setAttribute('image_formats', array('wide', 'preview', 'crop'));
        $view->setSerializationContext($context);

        return $this->handleView(
            $view
        );
    }

}
