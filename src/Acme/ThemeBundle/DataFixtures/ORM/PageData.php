<?php

namespace Acme\ThemeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Orm\Page;
use PhpInk\Nami\CoreBundle\Model\Orm\Image;
use PhpInk\Nami\CoreBundle\Model\Orm\Block;
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
}
