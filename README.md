Add MsiContentBundle :

    git submodule add -f git://github.com/alexisj/MsiContentBundle.git vendor/bundles/Msi/ContentBundle

Add to kernel :

    new Msi\ContentBundle\MsiContentBundle(),

Register namespace :

    'Msi'  => __DIR__.'/../vendor/bundles',

Add to routing :

    MsiContentBundle:
      resource: "@MsiContentBundle/Resources/config/routing.yml"