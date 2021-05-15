<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Entreprise;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\HttpFoundation\JsonResponse;





class UsercontrolerController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UsercontrolerController',
        ]);
    }
    /**
     * @Route("/register",name="register",methods={"post"})
     */
    public function register(Request $request,UserPasswordEncoderInterface  $encoder)
    {
        $result = json_decode($request->getContent(),true);

 //dd($result);
$em = $this->container->get('doctrine')->getManager();
$entreprise = $em->getRepository(Entreprise::class)->findOneBy(array('email' => $result['email']));
//dd($user);
if (!$entreprise){
    $entreprise = new Entreprise();
    $entreprise->setNomEnp($result['nom_enp'])
        ->setDomaineAct($result['domaine_act'])
        ->setLogin($result['login']) 
        ->setEmail($result['email'])
        ->setMotpass($encoder->encodePassword($entreprise,$result['motpass']));

    $em->persist($entreprise);
    $em->flush();

        $response = new Response();
        $response->setContent(json_encode(array(
            'message' => 'Job done !',
        )));
        $response->setStatusCode(200    );
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    //dd('user not found you can add new user');
    }
    $response = new Response();
    $response->setContent(json_encode(array(
        'message' => 'user already exist !',
    )));
    $response->setStatusCode(400    );
    $response->headers->set('Content-Type', 'application/json');
    return $response;

}


 /**
     * @Route("/getuser",name="getuser",methods={"post"})
     */


    public function getu(Request $request){

    $result = json_decode($request->getContent(),true);

    $em = $this->container->get('doctrine')->getManager();

    $entreprise = $em->getRepository(Entreprise::class)->findOneBy(array('email' => $result['email']));
    //dd($entreprise);
    //return true;

    $serializer=$this->container->get('serializer');
    $itemSerializer=$serializer->serialize($entreprise, 'json');
   // dd($itemSerializer);
    //return true;

    return new JsonResponse( $itemSerializer);







   // $response = new Response();
    //$response->setContent(json_encode(array(
      //  'message' => 'user already exist !',
    //)));
    //$response->setStatusCode(400    );
    //$response->headers->set('Content-Type', 'application/json');
    //return $response;
    

    
}




}



