<?php
/**
* Created by PhpStorm.
* User: user
* Date: 23/09/2017
* Time: 03:08.
*/
namespace EmploiyerBundle\Controller;

use EmploiyerBundle\Entity\Absence;
use EmploiyerBundle\Entity\Adresse;
use EmploiyerBundle\Entity\Mession;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MissionController  extends Controller
{
/**
* @Route("/ajoutMission/{id}" , name="ajoutMission")
*/
public function ajoutMission(Request $request, $id)
{

$messtion = new Mession();
    $repository = $this->getDoctrine()->getManager()->getRepository('EmploiyerBundle:Employe');
    $employer = $repository->findOneBy(array('id' => $id));



$form = $this->createFormBuilder($messtion)


->add('designation', TextType::class)
->add('periode', TextType::class)
->add('debut', DateType::class)
->add('ajouter', SubmitType::class)
->getForm();

$form->handleRequest($request);

if ($form->isValid() && $form->isSubmitted()) {

    $messtion->setEmployer($employer);



$em = $this->getDoctrine()->getManager();
$em->persist($messtion);
$em->flush();

return $this->redirect('http://localhost/my_project_name/web/app_dev.php/ListeMession');
}

return $this->render('EmploiyerBundle:Default:ajoutMession.html.twig',
    array('form' => $form->createView()));
}

    /**
     * @Route("/ListeMission")
     */

    public function ListeMessionAction(){

        $list=$this->getDoctrine()->getRepository("EmploiyerBundle:Mession")->findAll();


        return $this->render("EmploiyerBundle:Default:ListeMession.html.twig",array('list'=>$list));
    }

    /**
     * @Route("/AjoutAdresse")
     */

    public function AjoutAdresseAction(Request $request){

       $adresse =new Adresse();

       $form=$this->createFormBuilder($adresse)

           ->add('numero',TextType::class)
           ->add('rue',TextType::class)
           ->add('codePostal',TextType::class)
            ->add('ville',TextType::class)
           ->add('valider',SubmitType::class)

           ->getForm();

           $form->handleRequest($request);


        return $this->render("EmploiyerBundle:Default:AjoutAdresse.html.twig",
            array('form'=>$form->createView()));
    }


}
