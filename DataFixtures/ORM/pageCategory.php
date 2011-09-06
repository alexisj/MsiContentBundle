<?php
namespace Msi\ContentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Msi\ContentBundle\Entity\PageCategory;

class LoadPageCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load($manager)
  {
    $pageCategory = new PageCategory();
    $pageCategory->setName('General');
    $pageCategory->setStatus(true);

    $manager->persist($pageCategory);
    $manager->flush();
    
    $this->addReference(1, $pageCategory);
    
    $pageCategory = new PageCategory();
    $pageCategory->setName('News');
    $pageCategory->setStatus(true);

    $manager->persist($pageCategory);
    $manager->flush();
    
    $this->addReference(2, $pageCategory);
    
    $pageCategory = new PageCategory();
    $pageCategory->setName('Technology');
    $pageCategory->setStatus(true);

    $manager->persist($pageCategory);
    $manager->flush();
    
    $this->addReference(3, $pageCategory);
  }
  
  public function getOrder()
  {
    return 1; // the order in which fixtures will be loaded
  }
}