git submodule add -f git://github.com/alexisj/MsiContentBundle.git vendor/bundles/Msi/ContentBundle

new Msi\ContentBundle\MsiContentBundle(),

'Msi'  => __DIR__.'/../vendor/bundles',

MsiContentBundle:

    resource: "@MsiContentBundle/Resources/config/routing.yml"