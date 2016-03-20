<?php

namespace Acme\ThemeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Orm\Category;
use Acme\ThemeBundle\DataFixtures\FixturesTrait\CategoryDataTrait;

class CategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    use CategoryDataTrait;

    public function createModel()
    {
        return new Category();
    }
}
