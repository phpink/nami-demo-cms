<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(

            /**
             * Base bundles
             */
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new FOS\HttpCacheBundle\FOSHttpCacheBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            /**
             * Doctrine bundles (ORM storage)
             */
            //
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),

            // Add your extra storage here
            //new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
            //new Doctrine\Bundle\PHPCRBundle\DoctrinePHPCRBundle(),

            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),

            /**
             * Api bundles
             */
            new FOS\RestBundle\FOSRestBundle(),
            new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),
            new Gfreeau\Bundle\GetJWTBundle\GfreeauGetJWTBundle(),

            /**
             * Sonata admin (ORM storage)
             */
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            //...

            // Sonata admin storage bundle
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),

            // This example uses SonataDoctrineORMAdmin but it works the same with the alternatives
            //new Sonata\DoctrineMongoDBAdminBundle\SonataDoctrineMongoDBAdminBundle(),
            //new Sonata\DoctrinePHPCRAdminBundle\SonataDoctrinePHPCRAdminBundle(),

            // Then add SonataAdminBundle
            new Sonata\AdminBundle\SonataAdminBundle(),

            // Formatter
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),

            /**
             * Front, Back bundles
             */
            new PhpInk\Nami\CoreBundle\NamiCoreBundle(),
            new Acme\ThemeBundle\AcmeThemeBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test', 'local'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
