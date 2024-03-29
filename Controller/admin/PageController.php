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
    
    if (!$session->has('limit')) $session->set('limit', 15);
    
    $query = $this->getDoctrine()->getRepository('MsiContentBundle:Page')->findWithFilters($session->get('filters', array()));
    
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
    $entity = new Page;
    $form = $this->createForm(new PageType, $entity);
    return $this->render('MsiContentBundle:Page:admin/new.html.twig', array('form' => $form->createView()));
  }

  public function createAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $entity = new Page;
    
    $form = $this->createForm(new PageType(), $entity);
    $form->bindRequest($this->getRequest());
    
    if ($form->isValid()) {
      $entity->setUser($this->get('security.context')->getToken()->getUser());
      $em->persist($entity);
      $em->flush();
      
      $this->get('session')->setFlash('success', 'Your changes were saved!');
      return $this->redirect($this->generateUrl('page'));
    } else {
      return $this->render('MsiContentBundle:Page:admin/new.html.twig', array('form' => $form->createView()));
    }  
  }
  
  public function editAction($id)
  {
    $entity = $this->getDoctrine()->getRepository('MsiContentBundle:Page')->find($id);
    
    $form = $this->createForm(new PageType(), $entity);
    
    return $this->render('MsiContentBundle:Page:admin/edit.html.twig', array('id' => $id, 'form' => $form->createView()));
  }
  
  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $entity = $em->getRepository('MsiContentBundle:Page')->find($id);
    $form = $this->createForm(new PageType(), $entity);
    
    $form->bindRequest($this->getRequest());
    
    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();
      
      $this->get('session')->setFlash('success', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('page'));
    } else {
      return $this->render('MsiContentBundle:Page:admin/edit.html.twig', array('id' => $id, 'form' => $form->createView()));
    }
  }

  public function batchAction()
  {
    $session = $this->get('session');
    $request = $this->get('request')->request;
    $em = $this->getDoctrine()->getEntityManager();

    $ids = $request->get('ids');

    if ($ids) {
      switch($request->get('batch_action')) {
        case 'edit':
          return $this->redirect($this->generateUrl('page_edit', array('id' => $ids[0])));
        break;
        case 'publish':
          $em->getRepository('MsiContentBundle:Page')->publish($ids, $em);
        break;
        case 'unpublish':
          $em->getRepository('MsiContentBundle:Page')->unpublish($ids, $em);
        break;
        case 'delete':
          $em->getRepository('MsiContentBundle:Page')->delete($ids, $em);
        break;
      }
    } else {
      $session->setFlash('error', 'You must at least select one item.');
    }
    return $this->redirect($this->generateUrl('page'));
  }
}
