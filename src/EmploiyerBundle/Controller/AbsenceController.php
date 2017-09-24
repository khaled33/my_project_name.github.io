<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23/09/2017
 * Time: 03:08
 */

namespace EmploiyerBundle\Controller;


use EmploiyerBundle\Entity\absence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;




class AbsenceController extends Controller
{


    /**
     * @Route("/ajoutAbsence/{id}" , name="ajoutAbsence")
     */
    public function ajoutAction (Request $request ,$id)
    {
        $absence =new absence();

        $form=$this->createFormBuilder($absence)

            ->add('debut',DateType::class)
            ->add('fin',DateType::class)
            ->add('remarque',TextType::class)
            ->add('status',TextType::class)
            ->add('ajouter',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);


     if ($form->isValid() && $form->isSubmitted()){
             $absence->setIdEmp($id);
            $em=$this->getDoctrine()->getManager();
            $em->persist($absence);
            $em->flush();


         return $this->redirect('http://localhost/my_project_name/web/app_dev.php/ListeAbsence');
        }
        return $this->render('EmploiyerBundle:Default:ajoutAbsence.html.twig',array('form'=>$form->createView()));
    }


    /**
     * @route ("/ListeAbsence")
     */

    public function ListeAbsenceAction ()
    {

        $ListeAbsence=$this->getDoctrine()->getRepository("EmploiyerBundle:absence")->findAll();


    return $this->render('EmploiyerBundle:Default:ListeAbsence.html.twig',
        array('listAbsence'=>$ListeAbsence));
    }



}