<?php
namespace Msi\ContentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Msi\ContentBundle\Entity\Layout;

class LoadLayoutData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load($manager)
  {
    $layout = new layout();
    $layout->setName('layout');

    $manager->persist($layout);
    $manager->flush();
    
    $this->addReference('layout', $layout);
  }
  
  public function getOrder()
  {
    return 2; // the order in which fixtures will be loaded
  }
}