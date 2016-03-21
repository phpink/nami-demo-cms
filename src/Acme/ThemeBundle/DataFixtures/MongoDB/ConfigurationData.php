<?php

namespace Acme\ThemeBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Odm\Configuration;
use Acme\ThemeBundle\DataFixtures\FixturesTrait\ConfigurationDataTrait;

class ConfigurationData extends AbstractFixture implements OrderedFixtureInterface
{
    use ConfigurationDataTrait;

    public function createModel($name, $value)
    {
        return new Configuration($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
