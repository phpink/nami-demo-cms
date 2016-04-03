#!/usr/bin/env bash
php -r "readfile('https://getcomposer.org/installer');" | php;
php composer.phar install --ignore-platform-reqs;

# Database creation
php app/console doctrine:database:create;
php app/console doctrine:schema:update --force;

# Replace data-fixtures/lib/Purger/Purger.php buggy file (See https://github.com/doctrine/data-fixtures/pull/212)
wget https://raw.githubusercontent.com/macnibblet/data-fixtures/hotfix/updated-commit-order-calculator/lib/Doctrine/Common/DataFixtures/Purger/ORMPurger.php;
mv ORMPurger.php vendor/doctrine/data-fixtures/lib/Doctrine/Common/DataFixtures/Purger/ORMPurger.php;

# Fixtures load
php app/console doctrine:fixtures:load --no-interaction;

# Assets install
php app/console assets:install;
php app/console assetic:dump;