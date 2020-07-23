<?php
  namespace App\Controller;

  use App\Entity\Owner;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;

  class OwnerController extends AbstractController {


    /*
    * @Route("/products/", name="ownerList")
    * @Method({"GET"}) 
    */ 
    public function index() {

        $owners = $this->getDoctrine()
            ->getRepository(Owner::class)
            ->findAll();
        return $this->render( 
            'owners/index.html.twig', array(
            "owners" => $owners
        ));

    }

    /*
    * @Route("/products/create", name="ownerCreate")
    * @Method({"GET","POST"}) 
    */ 
    public function create( Request $request ) {

        $owner = new Owner();

        $form = $this->createFormBuilder($owner)
          ->add("name", TextType::class, array(
            "attr" => array("class" => "form-control")))
          ->add("submit", SubmitType::class, array(
            "label" => "Create",
            "attr" => array("class" => "btn btn-primary mt-3")))
          ->getForm();
  
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
          $article = $form->getData();
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($owner);
          $entityManager->flush();
          
          return $this->redirectToRoute('ownerList');
        }
  
        return $this->render("owners/create.html.twig", array(
          "form" => $form->createView()
        ));
  

    }

  }
