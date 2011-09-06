<?php
namespace Msi\ContentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Msi\ContentBundle\Entity\Page;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{
  public function load($manager)
  {
      $page = new Page();
      $page->setTitle('Home');
      $page->setBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
      $page->setPageCategory($manager->merge($this->getReference(1)));
      $page->setLayout($manager->merge($this->getReference('layout')));
      $page->setHome(true);
      $page->setStatus(true);
      $page->setAuthorId(1);
      $page->setUniqueTitle('home-fr');

      $manager->persist($page);
      $manager->flush();
    
    for ($i=0;$i<100;$i++) {
      $page = new Page();
      $page->setTitle('page_'.$i);
      $page->setBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
      $page->setPageCategory($manager->merge($this->getReference(rand(1,3))));
      $page->setLayout($manager->merge($this->getReference('layout')));
      $page->setHome(false);
      $page->setStatus(true);
      $page->setAuthorId(2);
      $page->setUniqueTitle('page_'.$i.'-fr');

      $manager->persist($page);
      $manager->flush();
    }
    
    for ($i=1000;$i<1100;$i++) {
      $page = new Page();
      $page->setTitle('page_'.$i);
      $page->setBody('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
      $page->setPageCategory($manager->merge($this->getReference(rand(1,3))));
      $page->setLayout($manager->merge($this->getReference('layout')));
      $page->setHome(false);
      $page->setStatus(false);
      $page->setAuthorId(3);
      $page->setUniqueTitle('page_'.$i.'-fr');

      $manager->persist($page);
      $manager->flush();
    }
  }
  
  public function getOrder()
  {
    return 3; // the order in which fixtures will be loaded
  }
}