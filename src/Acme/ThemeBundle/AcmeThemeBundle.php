<?php

namespace Acme\ThemeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeThemeBundle extends Bundle
{
    public function getParent()
    {
        return 'NamiCoreBundle';
    }
}
