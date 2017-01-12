<?php

namespace Application\UTBM\APIBundle\Controller;

use Application\Sonata\ClassificationBundle\Entity\Category;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\Request;

class LearningController extends FOSRestController
{

    /**
     * Fetching quiz list from HTTP request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listCategoriesAction( Request $request )
    {
        $category = $this->container->get('sonata.classification.manager.category')->findOneBy(
            array('name' => "TOEFL")
        );

        $view = $this->view( $category->getChildren(), 200 );

        $context = new SerializationContext();
        $context->setAttribute('image_formats', array('wide'));
        $view->setSerializationContext($context);

        return $this->handleView(
            $view
        );
    }

    /**
     * Fetching quiz list from HTTP request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listCardsAction( Request $request, Category $category )
    {
        $arrCards = $this->getDoctrine()->getRepository("ApplicationUTBMTOEFLBundle:Card")->findBy(array(
           'category' => $category
        ));

        $view = $this->view( $arrCards, 200 );

        $context = new SerializationContext();
        $context->setAttribute('image_formats', array('wide'));
        $view->setSerializationContext($context);

        return $this->handleView(
            $view
        );
    }

}
