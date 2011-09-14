<?php
namespace Msi\ContentBundle\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\ContentBundle\Entity\PageCategory;
use Symfony\Component\HttpFoundation\Response;
use Msi\ContentBundle\Form\PageCategoryType;

class PageCategoryController extends Controller
{
  public function indexAction()
  {
    $session = $this->get('session');
    $request = $this->get('request')->request;
    
    // Apply new filters.
    if ($this->get('request')->getMethod() == 'POST') {
      $session->set('limit', $request->get('limit'));
      $session->set('page_category_filters', $request->get('page_category_filters'));
      return $this->redirect($this->generateUrl('page_category'));
    }
    
    // Default filters.
    if (!$session->has('limit')) $session->set('limit', 15);
    if (!$session->has('page_category_filters')) $session->set('page_category_filters', array(
      'status' => -1,
    ));
    
    $query = $this->getDoctrine()->getRepository('MsiContentBundle:PageCategory')->findWithFilters($session->get('page_category_filters'));
    
    $adapter = $this->get('knp_paginator.adapter');
    $adapter->setQuery($query);
    $adapter->setDistinct(true);
    $paginator = new \Zend\Paginator\Paginator($adapter);
    $paginator->setCurrentPageNumber($this->get('request')->query->get('page', 1));
    $paginator->setItemCountPerPage($session->get('limit'));
    $paginator->setPageRange(10);

    return $this->render('MsiContentBundle:PageCategory:admin/index.html.twig', array(
      'session' => $session,
      'paginator' => $paginator,
    ));
  }

  public function newAction()
  {
    $page = new PageCategory;
    $form = $this->createForm(new PageCategoryType, $page);
    return $this->render('MsiContentBundle:PageCategory:admin/new.html.twig', array('form' => $form->createView()));
  }

  public function createAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $page = new PageCategory;
    
    $form = $this->createForm(new PageCategoryType(), $page);
    
    $form->bindRequest($this->getRequest());
    
    if ($form->isValid()) {
      $em->persist($page);
      $em->flush();
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('page_category'));
    } else {
      return $this->render('MsiContentBundle:PageCategory:admin/new.html.twig', array('page' => $page, 'form' => $form->createView()));
    }  
  }
  
  public function editAction($id)
  {
    $entity = $this->getDoctrine()->getRepository('MsiContentBundle:PageCategory')->find($id);
    
    $form = $this->createForm(new PageCategoryType(), $entity);
    
    return $this->render('MsiContentBundle:PageCategory:admin/edit.html.twig', array('id' => $id, 'form' => $form->createView()));
  }
  
  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $entity = $em->getRepository('MsiContentBundle:PageCategory')->find($id);
    $form = $this->createForm(new PageCategoryType(), $entity);
    
    $form->bindRequest($this->getRequest());
    
    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('page_category'));
    } else {
      return $this->render('MsiContentBundle:PageCategory:admin/edit.html.twig', array('id' => $id, 'form' => $form->createView()));
    }
  }
  
  public function resetFiltersAction()
  {
    $session = $this->get('session');
    // Default filters.
    $session->set('limit', 15);
    $session->set('page_category_filters', array(
      'status' => -1,
    ));

    return $this->redirect($this->generateUrl('page_category'));
  }
}
