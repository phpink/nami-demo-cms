<?php

namespace Acme\ThemeBundle\Controller;

use PhpInk\Nami\CoreBundle\Controller\FrontendController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends FrontendController
{
    public function newAction()
    {
        return new JsonResponse(array(
           'new' => true
        ));
    }
}
