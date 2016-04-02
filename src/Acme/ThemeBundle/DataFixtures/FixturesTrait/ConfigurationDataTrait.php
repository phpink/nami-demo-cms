<?php

namespace Acme\ThemeBundle\DataFixtures\FixturesTrait;

use Doctrine\Common\Persistence\ObjectManager;

trait ConfigurationDataTrait
{

    public function addConfiguration($name, $value)
    {
        $country = $this->createConfigModel($name, $value);
        $this->manager->persist($country);

    }

    /**
     * {@inheritDoc}
     */
    public function loadConfig(ObjectManager $manager)
    {
        $this->manager = $manager;
        $configuration = array(
          'title' => 'Nami Demo',
          'slogan' => ''
        );
        foreach ($configuration as $name => $value) {
            $this->addConfiguration($name, $value);
        }
        $this->manager->flush();
    }
}
