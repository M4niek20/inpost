<?php
  namespace App\Controller;
  use App\Entity\Product;
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

      $products = $this->getDoctrine()->getRepository(Aricle::class)->findAll();

      return $this->render('index.html.twig', array("name" => "Brad", "products" => ["no","nie"]));
    }

      
      // public function save(){
        
      //   /*
      //   * @Route("/product/save")
      //   * @Method({"GET"}) 
      //   */ 
      
      //   $product = new Product();
      //   $product->setName("Terminal");
      //   $product->setBarcode(12222311231);

      //   $entityManager = $this->getDoctrine()->getManager();
      //   $entityManager->persist($product);
      //   $entityManager->flush();

      //   return new Response("saved a product as id ".$product->getId());
      // }

  }