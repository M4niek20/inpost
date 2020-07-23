<?php
  namespace App\Controller;

  use App\Entity\Owner;
  use App\Entity\Stock;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  
  class OwnerController extends AbstractController {


    /*
    * @Route("/owners/", name="ownerList")
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
    * @Route("/owners/show/{id}", name="ownerShow")
    * @Method({"GET"}) 
    */ 
    public function show($id) {
      $owner = $this->getDoctrine()
      ->getRepository(Owner::class)
      ->find($id);

      return $this->render(
        "owners/show.html.twig", array(
        "owner" => $owner));
    }

    /*
    * @Route("/owners/create", name="ownerCreate")
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
          
          $owner = $form->getData();
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($owner);
          $entityManager->flush();
          
          return $this->redirectToRoute('ownerList');
        }
  
        return $this->render("owners/create.html.twig", array(
          "form" => $form->createView()
        ));
  

    }

    /*
    * @Route("/owners/expired", name="ownerExpirated")
    * @Method({"GET","POST"}) 
    */ 
    public function findExpiredProducts( Request $request ) {

      $owners = $this->getDoctrine()
      ->getRepository(Owner::class)
      ->findAll();
      
      $form = $this->createFormBuilder()
        ->add("owner", ChoiceType::class, array(
          "choices" => $owners,
          'choice_value' => 'getId',
          'choice_label' => function(?Owner $owners) {
            return $owners ? $owners->getName() : '';
          },
          "attr" => array("class" => "form-control")))
        ->add("submit", SubmitType::class, array(
          "label" => "Search",
          "attr" => array("class" => "btn btn-primary mt-3")))
        ->getForm();

      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()) {

        $owner = $form['owner']->getData();
        $dbConnection = $this->getDoctrine()->getManager()->getConnection();
        $sql = '
            SELECT p.name, s.id, s.expiration_date FROM Stock s
            INNER JOIN Product p ON s.product_id = p.id
            INNER JOIN Product_owners po ON p.id = po.product_id
            WHERE s.expiration_date < :currentDate and 
            po.owner_id = :ownerId
            ';

        $stmt = $dbConnection->prepare($sql);
        $stmt->execute([
          'currentDate' => date('Y-m-d'),
          'ownerId' => $owner->getId()
          ]);
        $query = $stmt->fetchAll();


        return $this->render("owners/expired.html.twig", array(
          "form" => $form->createView(),
          "products" => $query
        ));
      }

      return $this->render("owners/expired.html.twig", array(
        "form" => $form->createView()
      ));
    }


  }
