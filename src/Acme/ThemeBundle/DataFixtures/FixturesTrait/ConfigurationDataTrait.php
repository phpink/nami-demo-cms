<?php

namespace Acme\ThemeBundle\DataFixtures\FixturesTrait;

use Doctrine\Common\Persistence\ObjectManager;

trait ConfigurationDataTrait
{

    public function adAcmenfiguration($name, $value)
    {
        $country = $this->createModel($name, $value);
        $this->manager->persist($country);

    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $configuration = array(
          'title' => 'D-CO Paysage',
          'slogan' => ''
        );
        foreach ($configuration as $name => $value) {
            $this->adAcmenfiguration($name, $value);
        }
        $this->manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
