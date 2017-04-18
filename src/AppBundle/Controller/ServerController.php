<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Server;
use AppBundle\Form\ServerType;

class ServerController extends Controller
{

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
                return $this->render('server/create.html.twig', [
                  'sent'=>true,
                ]);
            }
            return $this->render('server/create.html.twig', [
              'form'=>$form->createView(),
            ]);
        }

}
