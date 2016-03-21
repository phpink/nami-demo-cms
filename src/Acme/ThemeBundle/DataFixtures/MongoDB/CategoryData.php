<?php

namespace Acme\ThemeBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Odm\Category;
use Acme\ThemeBundle\DataFixtures\FixturesTrait\CategoryDataTrait;

class CategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    use CategoryDataTrait;

    public function createModel()
    {
        return new Category();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}
