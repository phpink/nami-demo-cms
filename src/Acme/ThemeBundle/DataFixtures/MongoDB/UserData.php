<?php

namespace Acme\ThemeBundle\DataFixtures\MongoDB;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PhpInk\Nami\CoreBundle\Model\Odm\Image;
use Acme\ThemeBundle\DataFixtures\FixturesTrait\UserDataTrait;

class UserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    use UserDataTrait;

    public function createImageModel($name, $folder)
    {
        return new Image($name, $folder);
    }
}
