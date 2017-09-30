<?php

namespace EmploiyerBundle\Controller;


use EmploiyerBundle\Entity\Employe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction(Request $request)
    {
        $emp=new Employe();

        $form=$this->createFormBuilder($emp)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('email',EmailType::class)
            ->add('adress',TextType::class)
            ->add('dateNaissance',DateType::class, array('format' => 'dd-MM-yyyy'))
            ->add('nationalite',TextType::class)
            ->add('Valider',SubmitType::class)
       ->getForm();

        $form->handleRequest($request);
       if ($form->isValid() && $form->isSubmitted()){

           $em=$this->getDoctrine()->getManager();
           $em->persist($emp);
           $em->flush();
       }

        $employe=$this->getDoctrine()->getRepository("EmploiyerBundle:Employe")->findAll();

    return $this->render('EmploiyerBundle:Default:index.html.twig',
        array('form'=>$form->createView(),'emp'=>$employe));
    }

    /**
     * @Route ("/modifemployer/{id}", name="modifemployer")
     */
    public function modifAction ($id ,Request $request)
    {



        $reponse=$this->getDoctrine()->getManager()->getRepository("EmploiyerBundle:Employe");
        $employer=$reponse->findOneBy(array('id'=>$id));

        $form=$this->createFormBuilder($employer)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('email',EmailType::class)
            ->add('adress',TextType::class)
            ->add('dateNaissance',DateType::class, array('format' => 'dd-MM-yyyy'))
            ->add('nationalite',TextType::class)
            ->add('Valider',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);



        if ($form->isValid() && $form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($employer);
            $em->flush();
           return $this->redirect('http://localhost/my_project_name/web/app_dev.php/index');
        }


  return $this->render('EmploiyerBundle:Default:modifeEmploye.html.twig',
      array('form'=>$form->createView()));


    }


    /**
     * @Route ("supprimmer/{id}" ,name="supprimmer")
     */
    public function supprimerAction($id){

        $reponse=$this->getDoctrine()->getManager()->getRepository("EmploiyerBundle:Employe");
        $employer=$reponse->findOneBy(array('id'=>$id));

        if ($employer){
        $em=$this->getDoctrine()->getManager();
        $em->remove($employer);
        $em->flush();
      return $this->redirect('http://localhost/my_project_name/web/app_dev.php/index');
        }
      return $this->render('EmploiyerBundle:Default:supp.html.twig');

    }

}
