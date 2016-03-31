<?php

namespace Acme\ThemeBundle\DataFixtures\FixturesTrait;

use Doctrine\Common\Persistence\ObjectManager;

trait CategoryDataTrait
{
    public function createCategory($key, $data)
    {
        $category = $this->createCategoryModel();
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
    public function loadCategories(ObjectManager $manager)
    {
        $this->manager = $manager;

        $categories = array(
            /**
             * Main categories
             */
            'news' => array(
                'position' =>  2,
                'parent' => null,
                'name' => 'News',
                'title' => 'News category',
                'header' => 'News',
                'metaKeywords' => 'news,category,data',
                'metaDescription' => 'News category SEO',
                'content' => '<p>News category description</p>'
            ),            
            'Test' => array(
                'position' =>  2,
                'parent' => null,
                'name' => 'Test',
                'title' => 'Test category',
                'header' => 'Test',
                'metaKeywords' => 'test,category,db',
                'metaDescription' => 'Test category SEO',
                'content' => '<p>Test category description</p>>'
            ),
        );

        foreach ($categories as $key => $data) {
            $this->createCategory($key, $data);
        }

        $this->manager->flush();
    }
}
