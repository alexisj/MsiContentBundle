<?php
namespace Msi\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Msi\ContentBundle\Entity\Page;
use Symfony\Component\HttpFoundation\Response;
use Msi\ContentBundle\Form\PageType;

class PageController extends Controller
{
  public function indexAction()
  {
    $page = $this->getDoctrine()->getRepository('MsiContentBundle:Page')->findOneActiveBySlug();
    return $this->render('MsiContentBundle:Page:index.html.twig', array('page' => $page));
  }
  
  public function showAction($slug)
  {
    $page = $this->getDoctrine()->getRepository('MsiContentBundle:Page')->findOneActiveBySlug($slug);
    return $this->render('MsiContentBundle:Page:index.html.twig', array('page' => $page));
  }
}
