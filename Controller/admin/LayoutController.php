<?php
namespace Msi\ContentBundle\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\ContentBundle\Entity\Layout;
use Symfony\Component\HttpFoundation\Response;
use Msi\ContentBundle\Form\LayoutType;

class LayoutController extends Controller
{
  public function indexAction()
  {
    $session = $this->get('session');
    $request = $this->get('request')->request;
    
    $rows = $this->getDoctrine()->getRepository('MsiContentBundle:Layout')->findAll();

    return $this->render('MsiContentBundle:Layout:admin/index.html.twig', array(
      'session' => $session,
      'rows' => $rows,
    ));
  }

  public function newAction()
  {
    $page = new Layout;
    $form = $this->createForm(new LayoutType, $page);
    return $this->render('MsiContentBundle:Layout:admin/new.html.twig', array('form' => $form->createView()));
  }

  public function createAction()
  {
    $em = $this->getDoctrine()->getEntityManager();

    $entity = new Layout;
    
    $form = $this->createForm(new LayoutType(), $entity);
    
    $form->bindRequest($this->getRequest());
    
    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('layout'));
    } else {
      return $this->render('MsiContentBundle:Layout:admin/new.html.twig', array('entity' => $entity, 'form' => $form->createView()));
    }  
  }
  
  public function editAction($id)
  {
    $row = $this->getDoctrine()->getRepository('MsiContentBundle:Layout')->find($id);
    
    $form = $this->createForm(new LayoutType(), $page);
    
    return $this->render('MsiContentBundle:Layout:admin/edit.html.twig', array('row' => $row, 'form' => $form->createView()));
  }
  
  public function updateAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $entity = $em->getRepository('MsiContentBundle:Layout')->find($id);
    $form = $this->createForm(new LayoutType(), $entity);
    
    $form->bindRequest($this->getRequest());
    
    if ($form->isValid()) {
      $em->persist($entity);
      $em->flush();
      
      $this->get('session')->setFlash('notice', 'Your changes were saved!');
      
      return $this->redirect($this->generateUrl('layout'));
    } else {
      return $this->render('MsiContentBundle:Layout:admin/edit.html.twig', array('entity' => $entity, 'form' => $form->createView()));
    }
  }
}
