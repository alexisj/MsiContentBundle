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
    if (!$session->has('page_filters')) $this->setDefaultFilters();
    
    $query = $this->getDoctrine()->getRepository('MsiContentBundle:Page')->findWithFilters($session->get('page_filters'));
    
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

    $entity->setUser($this->get('security.context')->getToken()->getUser());
    
    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
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
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('page'));
    } else {
      return $this->render('MsiContentBundle:Page:admin/edit.html.twig', array('id' => $id, 'form' => $form->createView()));
    }
  }

  public function batchAction()
  {
    $request = $this->get('request')->request;
    $em = $this->getDoctrine()->getEntityManager();

    $this->get('session')->set('limit', $request->get('limit'));

    $ids = $request->get('ids');
    $batch_action = $request->get('batch_action');

    if ($ids) {
      if ($batch_action == 'delete') {
        foreach ($ids as $id) {
          $entity = $em->getRepository('MsiContentBundle:Page')->find($id);
          $em->remove($entity);
          $em->flush();
        }
      }
      if ($batch_action == 'edit') {
        return $this->redirect($this->generateUrl('page_edit', array('id' => $ids[0])));
      }
      if ($batch_action == 'publish') {
        foreach ($ids as $id) {
          $entity = $em->getRepository('MsiContentBundle:Page')->find($id);
          $entity->setStatus(true);
          $em->persist($entity);
          $em->flush();
        }
      }
      if ($batch_action == 'unpublish') {
        foreach ($ids as $id) {
          $entity = $em->getRepository('MsiContentBundle:Page')->find($id);
          $entity->setStatus(false);
          $em->persist($entity);
          $em->flush();
        }
      }
    }

    return $this->redirect($this->generateUrl('page'));
  }
  
  public function resetFiltersAction()
  {
    $this->setDefaultFilters();
    return $this->redirect($this->generateUrl('page'));
  }

  public function setFiltersAction()
  {
    $session = $this->get('session');
    $request = $this->get('request')->request;
    $session->set('page_filters', $request->get('page_filters'));
    return $this->redirect($this->generateUrl('page'));
  }

  protected function setDefaultFilters()
  {
    $session = $this->get('session');
    $session->set('page_filters', array(
      'page_category_id' => -1,
      'status' => -1,
      'user_id' => -1,
    ));
  }
}
