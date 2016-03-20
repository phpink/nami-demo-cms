<?php

namespace Acme\ThemeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Orm\Configuration;
use Acme\ThemeBundle\DataFixtures\FixturesTrait\ConfigurationDataTrait;

class ConfigurationData extends AbstractFixture implements OrderedFixtureInterface
{
    use ConfigurationDataTrait;

    public function createModel($name, $value)
    {
        return new Configuration($name, $value);
    }
}
