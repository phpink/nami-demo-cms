<?php

namespace Acme\ThemeBundle\Controller;

use PhpInk\Nami\CoreBundle\Controller\FrontendController as BaseFrontendController;
use Symfony\Component\HttpFoundation\JsonResponse;

class FrontendController extends BaseFrontendController
{
    public function testAction()
    {
        return new JsonResponse(array(
           'new' => true
        ));
    }
}
