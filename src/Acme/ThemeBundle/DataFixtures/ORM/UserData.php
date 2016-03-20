<?php

namespace Acme\ThemeBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Orm\Image;
use Acme\ThemeBundle\DataFixtures\FixturesTrait\UserDataTrait;

class UserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use UserDataTrait;

    public function createImageModel($name, $folder)
    {
        return new Image($name, $folder);
    }
}
