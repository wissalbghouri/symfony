<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
//return new response lazem ey controller ya3ml return response bibliotheque hal foundation
use App\Entity\Entreprise;
use App\Entity\AppelOffre;
use App\Entity\Offredemploi;
use App\Entity\Formation;


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











 /**
     * @Route("/addoffre",name="ajout_offre_emploi",methods={"post"})
     */
    public function addOffree(Request $request){
        $result = json_decode($request->getContent(),true);
        dump($result);
        $em = $this->container->get('doctrine')->getManager();
        $entreprise = $em->getRepository(Entreprise::class)->findOneBy(array('id' => (int)$result['entreprise']));
       
      // dd($entreprise); traja3 donne l entreprise li zedt offre d'emploi oa

        $oa = new Offredemploi();
        $oa->setTitreauposte($result['titreauposte']);
        $oa->setNombreposte($result['nombreposte']);
        $oa->setRegion($result['region']);
        $oa->setAdresse($result['adresse']);
     
        
        $oa->setSecteurenp($result['secteurenp']);
        $oa->setSalaire($result['salaire']);
        $oa->setLocal($result['local']);
        $oa->setEntreprise($entreprise);
 
        $em->persist($oa);
        $em->flush();
        $response = new Response();
                $response->setContent(json_encode(array(
                    'result' => 'Job done !',
                )));
                $response->setStatusCode(200    );
                $response->headers->set('Content-Type', 'application/json');
                return $response;
    }   






    
 /**
     * @Route("/formation",name="ajout_offre_formation",methods={"post"})
     */
    public function formation(Request $request){
        $result = json_decode($request->getContent(),true);
        dump($result);
        $em = $this->container->get('doctrine')->getManager();
        $entreprise = $em->getRepository(Entreprise::class)->findOneBy(array('id' => (int)$result['entreprise']));
       
      // dd($entreprise); traja3 donne l entreprise li zedt offre d'emploi oa

        $oa = new Formation();
        $oa->setNomEnp($result['nom_enp']);
        $oa->setTitre($result['titre']);
        $oa->setDomaine($result['domaine']);
        $oa->setPrix($result['prix']);
     
        
        $oa->setFormateur($result['formateur']);
       
        $oa->setEntreprise($entreprise);
 
        $em->persist($oa);
        $em->flush();
        $response = new Response();
                $response->setContent(json_encode(array(
                    'result' => 'Job done !',
                )));
                $response->setStatusCode(200    );
                $response->headers->set('Content-Type', 'application/json');
                return $response;
    } 





// Methode ta3 liste offre d'emploi w nbadlou ml forme objet ll form json

    
     /**
     * @Route("/getlapps",name="get_lapps",methods={"get"})
     */
    public function getAllUserss(){
        $em = $this->container->get('doctrine')->getManager();

        $us = $em->getRepository(Offredemploi::class)->findAll();
        
        $serializer = $this->container->get('serializer');
         $itemSerializer = $serializer->serialize($us, 'json');
        //dd($us);
         return new Response( $itemSerializer );
     // $response = new Response($itemSerializer );
       //  $response->setContent( $itemSerializer);
      //   $response->setStatusCode(200    );
     // $response->headers->set('Content-Type', 'application/json');
//  return $response;
       // return new Response();
    }




     /**
     * @Route("/getformation",name="get_formation",methods={"get"})
     */
    public function getformation(){
        $em = $this->container->get('doctrine')->getManager();

        $us = $em->getRepository(Formation::class)->findAll();
        
        $serializer = $this->container->get('serializer');
         $itemSerializer = $serializer->serialize($us, 'json');
        //dd($us);
         return new Response( $itemSerializer );
     // $response = new Response($itemSerializer );
       //  $response->setContent( $itemSerializer);
      //   $response->setStatusCode(200    );
     // $response->headers->set('Content-Type', 'application/json');
//  return $response;
       // return new Response();
    }


























     /**
     * @Route("/getlapp",name="get_lapp",methods={"get"})
     */
    public function getAllUsers(){
        $em = $this->container->get('doctrine')->getManager();

        $us = $em->getRepository(AppelOffre::class)->findAll();
        
        $serializer = $this->container->get('serializer');
         $itemSerializer = $serializer->serialize($us, 'json');
        //dd($us);
         return new Response( $itemSerializer );
     // $response = new Response($itemSerializer );
       //  $response->setContent( $itemSerializer);
      //   $response->setStatusCode(200    );
     // $response->headers->set('Content-Type', 'application/json');
//  return $response;
       // return new Response();
    }








    
}
