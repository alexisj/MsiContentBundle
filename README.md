1. Get the bundle
git submodule add -f git://github.com/alexisj/MsiContentBundle.git vendor/bundles/Msi/ContentBundle

2. Add to kernel
new Msi\ContentBundle\MsiContentBundle(),

3. Register namespace
'Msi'  => __DIR__.'/../vendor/bundles',

4. Add route
MsiContentBundle:
  resource: "@MsiContentBundle/Resources/config/routing.yml"