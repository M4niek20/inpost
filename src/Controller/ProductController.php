<?php
  namespace App\Controller;

  use App\Entity\Product;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  // forms
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\HttpFoundation\Request;

  class ProductController extends AbstractController {

    /*
    * @Route("/", name="listProduct")
    * @Method({"GET"}) 
    */ 
    public function index() {

      $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

      return $this->render(
        'index.html.twig',
         array("name" => "Brad", "products" => $products)
      );
    }

    // /*
    // * @Route("/products/find", name="findProduct")
    // * @Method({"GET"}) 
    // */
    // public function find(Request $request){

    //   $product = new Product();

    //   $form = $this->createFormBuilder($product)
    //           ->add("barcode", TextType::class, array(
    //             "attr" => array("class" => "form-control")))
    //           ->add("submit", SubmitType::class, array(
    //             "label" => "Search",
    //             "attr" => array("class" => "btn btn-primary mt-3")))
    //           ->getForm();

    //   return $this->render("products/find.html.twig", array(
    //     "form" => $form->createView()
    //     ));

    // }  

    /*
    * @Route("/products/show/{id}", name="showProduct")
    */
    public function show($id){
      
      $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

      // $asd = $product->getProducts();
      // foreach($asd as $owners){
      //   var_dump($owners->getOwner()->getName());
      // }
      // return new Response();
      
      return $this->render("products/show.html.twig", array("product" => $product));

    }  

    /*
    * @Route("/products/create")
    * @Method({"GET", "POST"}) 
    */ 
    public function create(Request $request){
    
      $product = new Product();

      $form = $this->createFormBuilder($product)
              ->add("name", TextType::class, array(
                "attr" => array("class" => "form-control")))
              ->add("barcode", TextType::class, array(
                "attr" => array("class" => "form-control")))
              ->add("submit", SubmitType::class, array(
                "label" => "Create",
                "attr" => array("class" => "btn btn-primary mt-3")))
              ->getForm();

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()) {
        $article = $form->getData();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        
        return $this->redirectToRoute('index');
      }


      return $this->render("products/create.html.twig", array(
        "form" => $form->createView()
      ));

    }

    /*
    * @Route("/products/delete/{id}")
    * @Method({"DELETE"}) 
    */ 
    public function delete(Request $request, $id){
    
      $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($product);
      $entityManager->flush();
      
      $response = new Response();
      return $response;
    }

  }