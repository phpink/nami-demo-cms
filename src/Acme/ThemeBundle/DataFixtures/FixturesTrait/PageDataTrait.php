<?php

namespace Acme\ThemeBundle\DataFixtures\FixturesTrait;

use Doctrine\Common\Persistence\ObjectManager;

trait PageDataTrait
{
    private $images = array();

    public function createImage($data, $folder)
    {
        $background = null;
        if (is_array($data)) {
            if (!array_key_exists($data['url'], $this->images)) {
                $background = $this->createImageModel($data['name'], $folder);
                $background->setFilename($data['url']);
                $this->images{$data['url']} = $background;
            } else {
                $background = $this->images{$data['url']};
            }
        }
        return $background;
    }

    public function createPage($key, $data)
    {
        $page = $this->createPageModel();
        $page
            ->setTitle($data['title'])
            ->setSlug($key)
            ->setActive(true)
            ->setHeader($data['header'])
            ->setContent(null)
            ->setMetaKeywords($data['metaKeywords'])
            ->setMetaDescription($data['metaDescription'])
            ->setBackground(
                $this->createImage(
                    $data['background'], 'background'
                )
            )
            ->setBackgroundColor($data['backgrounAcmelor'])
            ->setBorderColor($data['borderColor'])
            ->setFooterColor($data['footerColor'])
            ->setNegativeText($data['negativeText']);

        if ($data['category']) {
            $page->setCategory(
                $this->getReference('category_'. $data['category'])
            );
        }
        foreach ($data['blocks'] as $index => $blockData) {
            $block = $this->createBlockModel(
                $blockData['title'],
                $blockData['content']
            );
            $block->setPosition($index);
            foreach ($blockData['images'] as $image) {
                $block->addImage(
                    $this->createImage(
                        $image, 'block'
                    )
                );
            }
            if (array_key_exists('template', $blockData)) {
                $block->setTemplate($blockData['template']);
            }
            if (array_key_exists('type', $blockData)) {
                $block->setType($blockData['type']);
            }
            $page->addBlock($block);
        }

        $this->manager->persist($page);
        $this->addReference('page_'. $key, $page);

    }

    /**
     * {@inheritDoc}
     */
    public function loadPages(ObjectManager $manager)
    {
        $this->manager = $manager;
        $pages = array(
            'index' => array(
                'title' => "Nami CMS Demo",
                'header' => 'NAMI <strong>CMS</strong> demo app',
                'metaKeywords' => "paysagiste, bordeaux, jardin, entretien, gironde, Acme paysage",
                'metaDescription' => "Étude, création et entretien d'espaces verts (Gironde, 33).",
                'background' => null,
                'category' => null,
                'backgrounAcmelor' => null,
                'borderColor' => null,
                'footerColor' => null,
                'negativeText' => false,
                'blocks' => array(
                    array(
                        'title' => 'Paysagiste',
                        'content' => '<p><span itemprop="description">Content managin system</span> à
                              <span itemprop="addressLocality">Bordeaux</span> en
                              <span itemprop="addressRegion">Gironde (33)</span> et
                              dans le <span itemprop="addressRegion">Sud-Ouest</span>.</p>',
                        'template' => 'front',
                        'images' => array(
                            array(
                                'name' => "Nami Logo",
                                'url' => 'logo.jpg'
                            )
                        )
                    ),
                    array(
                        'title' => null,
                        'content' => '<section>
                              <p>Innovation, high-end, Symfony stack.</p>
                              <p>Improve your content administration</p>
                              <p>Optimisze your website.</p>
                          </section>',
                        'images' => array()
                    )
                )

            ),
            'contact' => array(
                'title' => "Contact us",
                'header' => 'Contact form',
                'metaKeywords' => "contact, form, write to us",
                'metaDescription' => "Contact form to write us",
                'background' => null,
                'category' => null,
                'images' => array(),
                'backgrounAcmelor' => null,
                'borderColor' => null,
                'footerColor' => null,
                'negativeText' => false,
                'blocks' => array(
                    array(
                        'title' => '',
                        'content' => '',
                        'type' => 'ContactForm',
                        'template' => 'contact',
                        'images' => array()
                    )
                )
            ),
        );

        foreach ($pages as $key => $data) {
            $this->createPage($key, $data);
        }

        $this->manager->flush();
    }
}
