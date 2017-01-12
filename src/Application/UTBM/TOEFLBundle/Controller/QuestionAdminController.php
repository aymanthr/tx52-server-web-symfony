<?php

namespace Application\UTBM\TOEFLBundle\Controller;


use Sonata\AdminBundle\Controller\CRUDController;

class QuestionAdminController extends CRUDController
{
    public function indexAction($name)
    {
        return $this->render('ApplicationUTBMTOEFLBundle:Default:index.html.twig', array('name' => $name));
    }
}
