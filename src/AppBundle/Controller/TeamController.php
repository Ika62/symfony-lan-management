<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;


class TeamController extends Controller
{

    /**
     * @Route("/teams/create", name="team_create")
     */
    public function teamAction(Request $request)
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $team = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            return $this->render('team/create.html.twig', [
              'sent'=>true,
            ]);
        }
        return $this->render('team/create.html.twig', [
          'form'=>$form->createView(),
        ]);
    }
}
