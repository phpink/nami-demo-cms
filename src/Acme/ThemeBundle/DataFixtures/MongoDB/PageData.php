<?php

namespace Acme\ThemeBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Odm\Page;
use PhpInk\Nami\CoreBundle\Model\Odm\Image;
use PhpInk\Nami\CoreBundle\Model\Odm\Block;
use Acme\ThemeBundle\DataFixtures\FixturesTrait\PageDataTrait;


class PageData extends AbstractFixture implements OrderedFixtureInterface
{
    use PageDataTrait;

    public function createModel()
    {
        return new Page();
    }

    public function createImageModel($name, $folder)
    {
        return new Image($name, $folder);
    }

    public function createBlockModel($title, $content)
    {
        return new Block($title, $content);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 6;
    }
}
