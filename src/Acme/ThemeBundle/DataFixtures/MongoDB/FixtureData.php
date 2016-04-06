<?php

namespace Acme\ThemeBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use PhpInk\Nami\CoreBundle\Model\Odm as Model;
use Acme\ThemeBundle\DataFixtures\FixturesTrait;

class FixtureData extends AbstractFixture implements ContainerAwareInterface
{
    use FixturesTrait\CategoryDataTrait;
    use FixturesTrait\ConfigurationDataTrait;
    use FixturesTrait\UserDataTrait;
    use FixturesTrait\PageDataTrait;
    use FixturesTrait\MenuDataTrait;


    public function load(ObjectManager $manager)
    {
        $this->loadConfig($manager);
        $this->loadUsers($manager);
        $this->loadCategories($manager);
        $this->loadPages($manager);
        $this->loadMenuLinks($manager);
    }

    public function createPageModel()
    {
        return new Model\Page();
    }

    public function createImageModel($name, $folder)
    {
        return new Model\Image($name, $folder);
    }

    public function createBlockModel($title, $content)
    {
        return new Model\Block($title, $content);
    }

    public function createCategoryModel()
    {
        return new Model\Category();
    }

    public function createConfigModel($name, $value)
    {
        return new Model\Configuration($name, $value);
    }

    public function createMenuLinkModel()
    {
        return new Model\MenuLink();
    }
}
