<?php

namespace Acme\ThemeBundle\DataFixtures\FixturesTrait;

use Doctrine\Common\Persistence\ObjectManager;

trait CategoryDataTrait
{
    public function createCategory($key, $data)
    {
        $category = $this->createModel();
        $category
            ->setActive(true)
            ->setPosition($data['position'])
            ->setName($data['name'])

            ->setTitle($data['title'])
            ->setHeader($data['header'])
            ->setContent($data['content'])
            ->setMetaKeywords($data['metaKeywords'])
            ->setMetaDescription($data['metaDescription']);

        if ($data['parent'] !== null) {
            $category->setParent(
                $this->getReference(
                    'category_'. $data['parent']
                )
            );
        }
        $this->manager->persist($category);
        $this->addReference('category_'. $key, $category);
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $categories = array(
            /**
             * Main categories
             */
            'first' => array(
                'position' =>  2,
                'parent' => null,
                'name' => 'First',
                'title' => 'First category',
                'header' => 'First',
                'metaKeywords' => 'first,category,data',
                'metaDescription' => 'First category SEO',
                'content' => '<p>First category description</p>'
            ),            
            'Sscond' => array(
                'position' =>  2,
                'parent' => null,
                'name' => 'Second',
                'title' => 'Second category',
                'header' => 'Second',
                'metaKeywords' => 'second,category,db',
                'metaDescription' => 'Second category SEO',
                'content' => '<p>Second category description</p>>'
            ),
        );

        foreach ($categories as $key => $data) {
            $this->createCategory($key, $data);
        }

        $this->manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}
