<?php

namespace NamiPlugin\Sitemap\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use PhpInk\Nami\CoreBundle\Repository\RepositoryInterface;

class SitemapController extends Controller
{
    public function indexAction()
    {
        $em = $this->getManager();
        /** @var RepositoryInterface $pageRepo */
        $pageRepo = $em->getRepository('NamiCoreBundle:Page');
        /** @var RepositoryInterface $categoryRepo */
        $categoryRepo = $em->getRepository('NamiCoreBundle:Category');
        return JsonResponse::create(
            array_merge(
                $pageRepo->getPageRoutes(),
                $categoryRepo->getCategoryRoutes()
            )
        );
    }

    protected function getManager()
    {
        return ($this->container->getParameter('nami_core.database_adapter') === 'odm') ?
            $this->get('doctrine_mongodb')->getManager() :
            $this->getDoctrine()->getManager();
    }
}

