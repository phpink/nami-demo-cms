<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(

            /**
             * Shared bundles [Back & Front]
             */
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new FOS\HttpCacheBundle\FOSHttpCacheBundle(),

            /**
             * Core bundles
             */
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            //new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
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
             * Front, Back bundles
             */
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new PhpInk\Nami\CoreBundle\NamiCoreBundle(),
            new PhpInk\Nami\AdminBundle\NamiAdminBundle(),
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
