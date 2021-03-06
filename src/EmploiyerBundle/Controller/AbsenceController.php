<?php
/**
* Created by PhpStorm.
* User: user
* Date: 23/09/2017
* Time: 03:08.
*/
namespace EmploiyerBundle\Controller;

use EmploiyerBundle\Entity\Absence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AbsenceController  extends Controller
{
/**
* @Route("/ajoutAbsence/{id}" , name="ajoutAbsence" ,requirements={"id": "\d+"})
*/
public function ajoutAction(Request $request, $id)
{
$absence = new absence();

$form = $this->createFormBuilder($absence)

->add('debut', DateType::class)
->add('fin', DateType::class)
->add('remarque', TextType::class)
->add('status', TextType::class)
->add('ajouter', SubmitType::class)
->getForm();

$form->handleRequest($request);

if ($form->isValid() && $form->isSubmitted()) {
$repository = $this->getDoctrine()->getManager()->getRepository('EmploiyerBundle:Employe');
$employer = $repository->findOneBy(array('id' => $id));

$absence->setEmploye($employer);

$Debut = $absence->getDebut();
$Fin = $absence->getFin();
$interval = $Fin->diff($Debut);
$interval->format('%R%a ');

$absence->setDiff($interval->days);

$em = $this->getDoctrine()->getManager();
$em->persist($absence);
$em->flush();

return $this->redirectToRoute('listAbcence');
}

return $this->render('EmploiyerBundle:Default:ajoutAbsence.html.twig', array('form' => $form->createView()));
}

/**
* @route ("/ListeAbsence" ,name="listAbcence")
*/
public function ListeAbsenceAction()
{
$ListeAbsence = $this->getDoctrine()->getRepository('EmploiyerBundle:Absence')->findAll();

return $this->render('EmploiyerBundle:Default:ListeAbsence.html.twig',
array('listAbsence' => $ListeAbsence));
}

/**
* @route ("/ListeAbsence/{id}" ,name="listeAbsenceBtId" ,requirements={"id": "\d+"})
*/
public function ListeAbsencByEempoyerAction($id)
{
$employe = $this->getDoctrine()->getManager()->getRepository('EmploiyerBundle:Employe')->findOneBy(array('id' => $id));

$ListeAbsence = $this->getDoctrine()->getRepository('EmploiyerBundle:Absence')->findBy(array('employe_id' => $id));
$sommeAbsence = 0;
for ($i = 0; $i < count($ListeAbsence); ++$i) {
$sommeAbsence += $ListeAbsence[$i]->getDiff();
}

return $this->render('EmploiyerBundle:Default:ListeAbsenceByemployer.html.twig',
array('listAbsence' => $ListeAbsence, 'emp' => $employe, 'somme' => $sommeAbsence));
}
}
