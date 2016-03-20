<?php

namespace Acme\ThemeBundle\Controller;

use PhpInk\Nami\CoreBundle\Controller\FrontenAcmentroller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends FrontenAcmentroller
{
    public function routingAction()
    {
        $response = new Response('', 200, array(
            'content-type' => 'application/javascript'
        ));
        $this->initRepositories();
        return $this->render(
            'NamiCoreBundle:default:routing.js.twig',
            array(
                'routes' => array_merge(
                    $this->pageRepo->getPageRoutes(),
                    $this->categoryRepo->getCategoryRoutes()
                ),
                'host' => $this->container->getParameter('host'),
                'isProd' => ($this->get('kernel')->getEnvironment() === 'prod')
            ), $response
        );

    }
}
