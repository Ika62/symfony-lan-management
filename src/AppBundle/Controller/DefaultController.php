<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Team;
use AppBundle\Entity\Game;
use AppBundle\Entity\Server;
use AppBundle\Form\TeamType;
use AppBundle\Form\ServerType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $teamRepository = $this->getDoctrine()->getRepository('AppBundle:Team');
        $serverRepository = $this->getDoctrine()->getRepository('AppBundle:Server');
        $teams = $teamRepository->findAll();
        $servers = $serverRepository->findAll();
        return $this->render('default/index.html.twig', [
             'teams'=>$teams,
             'servers'=>$servers,
        ]);
    }

    /**
     * @Route("/veto", name="veto")
     */
    public function vetoAction(Request $request)
    {
        $team1Field = $request->request->get('equipe1');
        $team2Field = $request->request->get('equipe2');
        $boField = $request->request->get('format');
        $serverField = $request->request->get('serveur');

        $em = $this->getDoctrine()->getManager();
        $team1 = $em->find('AppBundle:Team', $team1Field);
        $team2 = $em->find('AppBundle:Team', $team2Field);
        $server = $em->find('AppBundle:Server', $serverField);

        $game = new Game();
        $game->setServer($server);
        $game->setTeam1($team1);
        $game->setTeam2($team2);

        $em->persist($game);
        $em->flush();

        return $this->render('default/veto.html.twig', [
          'game'=>$game,
          'bo'=>$boField,
        ]);
    }

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
            return $this->render('create/team.html.twig', [
              'sent'=>true,
            ]);
        }
        return $this->render('create/team.html.twig', [
          'form'=>$form->createView(),
        ]);
    }


        /**
         * @Route("/servers/create", name="server_create")
         */
        public function serverAction(Request $request)
        {
            $server = new Server();
            $form = $this->createForm(ServerType::class, $server);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $team = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($team);
                $em->flush();
                return $this->render('create/server.html.twig', [
                  'sent'=>true,
                ]);
            }
            return $this->render('create/server.html.twig', [
              'form'=>$form->createView(),
            ]);
        }

}
