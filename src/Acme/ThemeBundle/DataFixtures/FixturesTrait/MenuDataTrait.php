<?php

namespace Acme\ThemeBundle\DataFixtures\FixturesTrait;

use Doctrine\Common\Persistence\ObjectManager;

trait MenuDataTrait
{
    public function createMenuLink($key, $data)
    {
        $category = $this->createMenuLinkModel();
        $category
            ->setActive(true)
            ->setPosition($data['position'])
            ->setName($data['name'])

            ->setTitle($data['title'])
            ->setLink($data['link']);

        if ($data['parent'] !== null) {
            $category->setParent(
                $this->getReference(
                    'menu_'. $data['parent']
                )
            );
        }
        $this->manager->persist($category);
        $this->addReference('menu_'. $key, $category);
    }

    /**
     * {@inheritDoc}
     */
    public function loadMenuLinks(ObjectManager $manager)
    {
        $this->manager = $manager;

        $menuLinks = array(
            /**
             * Main menu links
             */
            'home' => array(
                'position' =>  0,
                'parent' => null,
                'name' => 'Home',
                'title' => 'Back to the homepage',
                'link' => '/',
            ),
            'news' => array(
                'position' =>  1,
                'parent' => null,
                'name' => 'News',
                'title' => 'News category',
                'link' => '/news',
            ),
            'test' => array(
                'position' =>  1,
                'parent' => null,
                'name' => 'Test',
                'title' => 'Test category',
                'link' => '/test',
            ),
            'contact' => array(
                'position' =>  2,
                'parent' => null,
                'name' => 'Contact',
                'title' => 'Contact form',
                'link' => '/contact',
            ),

            # Sub links

            'news1' => array(
                'position' =>  1,
                'parent' => 'news',
                'name' => 'News 1',
                'title' => 'News 1',
                'link' => '/news/news1',
            ),

            'news2' => array(
                'position' =>  1,
                'parent' => 'news',
                'name' => 'News 2',
                'title' => 'News 2',
                'link' => '/news/news2',
            ),
        );

        foreach ($menuLinks as $key => $data) {
            $this->createMenuLink($key, $data);
        }

        $this->manager->flush();
    }
}
