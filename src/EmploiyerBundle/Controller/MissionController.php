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
* @Route("/ajoutMission/{id}" , name="ajoutMission",requirements={"id": "\d+"})
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

return $this->redirectToRoute('listeMission');
}

return $this->render('EmploiyerBundle:Default:ajoutMession.html.twig',
    array('form' => $form->createView()));
}

    /**
     * @Route("/ListeMission" ,name="listeMission" )
     */

    public function ListeMessionAction(){

        $list=$this->getDoctrine()->getRepository("EmploiyerBundle:Mession")->findAll();


        return $this->render("EmploiyerBundle:Default:ListeMession.html.twig",array('list'=>$list));
    }




}
