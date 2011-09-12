<?php
namespace Msi\ContentBundle\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\ContentBundle\Entity\Page;
use Symfony\Component\HttpFoundation\Response;
use Msi\ContentBundle\Form\PageType;

class PageController extends Controller
{
  public function indexAction()
  {
    $session = $this->get('session');
    
    if ($this->get('request')->getMethod() == 'POST') {
      $request = $this->get('request')->request;
      $session->set('limit', $request->get('limit'));
      $session->set('filters', $request->get('filters'));
      return $this->redirect($this->generateUrl('page'));
    }
    
    // Default filters.
    if (!$session->has('limit')) $session->set('limit', 15);
    if (!$session->has('filters')) $session->set('filters', array(
      'page_category_id' => -1,
      'published' => -1,
      'user_id' => -1,
    ));
    
    $query = $this->getDoctrine()->getRepository('MsiContentBundle:Page')->findWithFilters($session->get('filters'));
    
    $adapter = $this->get('knp_paginator.adapter');
    $adapter->setQuery($query);
    $adapter->setDistinct(true);
    $paginator = new \Zend\Paginator\Paginator($adapter);
    $paginator->setCurrentPageNumber($this->get('request')->query->get('page', 1));
    $paginator->setItemCountPerPage($session->get('limit'));
    $paginator->setPageRange(10);
    
    $pageCategories = $this->getDoctrine()->getRepository('MsiContentBundle:PageCategory')->findAll();
    $users = $this->getDoctrine()->getRepository('MsiUserBundle:User')->findAll();

    return $this->render('MsiContentBundle:Page:admin/index.html.twig', array(
      'session' => $session,
      'paginator' => $paginator,
      'pageCategories' => $pageCategories,
      'users' => $users,
    ));
  }

  public function newAction()
  {
    $page = new Page;
    $form = $this->createForm(new PageType, $page);
    return $this->render('MsiContentBundle:Page:admin/new.html.twig', array('form' => $form->createView()));
  }

  public function createAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $page = new Page;
    
    $form = $this->createForm(new PageType(), $page);
    
    $form->bindRequest($this->getRequest());
    $page->setUser($this->get('security.context')->getToken()->getUser());
    
    if ($form->isValid()) {
      $em->persist($page);
      $em->flush();
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('page'));
    } else {
      return $this->render('MsiContentBundle:Page:admin/new.html.twig', array('page' => $page, 'form' => $form->createView()));
    }  
  }
  
  public function editAction($id)
  {
    $page = $this->getDoctrine()->getRepository('MsiContentBundle:Page')->find($id);
    
    $form = $this->createForm(new PageType(), $page);
    
    return $this->render('MsiContentBundle:Page:admin/edit.html.twig', array('page' => $page, 'form' => $form->createView()));
  }
  
  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $page = $em->getRepository('MsiContentBundle:Page')->find($id);
    $form = $this->createForm(new PageType(), $page);
    
    $form->bindRequest($this->getRequest());
    
    if ($form->isValid()) {
      $em->persist($page);
      $em->flush();
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('page'));
    } else {
      return $this->render('MsiContentBundle:Page:admin/edit.html.twig', array('page' => $page, 'form' => $form->createView()));
    }
  }
  
  public function resetFiltersAction()
  {
    $session = $this->get('session');
    // Default filters.
    $session->set('limit', 15);
    $session->set('filters', array(
      'page_category_id' => -1,
      'published' => -1,
      'user_id' => -1,
    ));

    return $this->redirect($this->generateUrl('page'));
  }
}
