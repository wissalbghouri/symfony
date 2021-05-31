<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Entreprise;
use App\Entity\AppelOffre;


class AppelOffreController extends AbstractController
{
    /**
     * @Route("/appel/offre", name="appel_offre")
     */
    public function index(): Response
    {
        return $this->render('appel_offre/index.html.twig', [
            'controller_name' => 'AppelOffreController',
        ]);
    }

     /**
     * @Route("/addappeloffre",name="ajout_appel_offre",methods={"post"})
     */
    public function addProfile(Request $request){
        $result = json_decode($request->getContent(),true);
        dump($result);
        $em = $this->container->get('doctrine')->getManager();
        $entreprise = $em->getRepository(Entreprise::class)->findOneBy(array('id' => (int)$result['entreprise']));
        $ao = new AppelOffre();
        $ao->setTitre($result['titre']);
     //   $ao->setDateDebut($result['datedebut']); new \DateTime()
       // $ao->setDateFin($result['datefin']);
               $ao->setDateDebut(new \DateTime($result['datedebut'])); 
        $ao->setDateFin(new \DateTime($result['datefin']));
        $ao->setDescription($result['description']);
        $ao->setEntreprise($entreprise);
 
        $em->persist($ao);
        $em->flush();
        $response = new Response();
                $response->setContent(json_encode(array(
                    'result' => 'Job done !',
                )));
                $response->setStatusCode(200    );
                $response->headers->set('Content-Type', 'application/json');
                return $response;
    }   
}
