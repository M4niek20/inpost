<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  class ProductController extends AbstractController {
    
    public function index() {
      /*
      * @Route("/")
      * @Method({"GET"}) 
      */ 

      return $this->render('index.html.twig', array("name" => "Brad", "products" => ["no","nie"]));
    }

  }