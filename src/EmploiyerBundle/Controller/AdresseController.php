<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05/10/2017
 * Time: 11:07
 */

namespace EmploiyerBundle\Controller;


use EmploiyerBundle\Entity\Adresse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdresseController extends Controller
{

    /**
     * @Route("/AjoutAdresse/{id}" , name="ajoutAbresse")
     *
     */

     public function AjoutAdresseAction(Request $request,$id){

        $adresse =new Adresse();
        $response=$this->getDoctrine()->getManager()->getRepository("EmploiyerBundle:Mession");
        $mission=$response->findOneBy(array('id' => $id));

        $form=$this->createFormBuilder($adresse)

            ->add('numero',TextType::class)
            ->add('rue',TextType::class)
            ->add('codePostal',TextType::class)
            ->add('ville',TextType::class)
            ->add('valider',SubmitType::class)

            ->getForm();

        $form->handleRequest($request);
         if ($form->isValid() && $form->isSubmitted()) {
             $mission->setAdresse($adresse);
             $em = $this->getDoctrine()->getManager();
             $em->persist($adresse);
             $em->persist($adresse);
             $em->flush();

             return $this->redirectToRoute('listeMission');
         }

        return $this->render("EmploiyerBundle:Default:AjoutAdresse.html.twig",
            array('form'=>$form->createView()));
    }

}