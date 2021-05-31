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
     * @Route("/editProfil",name="edit_profil",methods={"post"})
     */
    public function editProfile(Request $request){
        $result = json_decode($request->getContent(),true);
        $em = $this->container->get('doctrine')->getManager();
        $Entreprise = $em->getRepository(Entreprise::class)->findOneBy(array('id' => (int)$result['idUser']));
        if($Entreprise){

           // dd($Entreprise->getEmail());
           if($Entreprise->getEmail() == $result['email']){
              // dd('here');
            $Entreprise->setNomEnp($result['nomEnp'])
            ->setDomaineAct($result['domaineAct'])
            ->setLogin($result['login'])
            ->setNumtel($result['numtel'])
            ->setSiteweb($result['siteweb'])
            ->setCategorie($result['categorie'])
            ->setLogo($result['logo'])
           // ->setMotpass($result['motpass'])

            //->setTypeEnp($result['typeEnp'])
          
            ->setAdresse($result['adresse']);

            $em->persist($Entreprise);
            $em->flush();
            $response = new Response();
                    $response->setContent(json_encode(array(
                        'result' => 'Job done !',
                    )));
                    $response->setStatusCode(200    );
                    $response->headers->set('Content-Type', 'application/json');
                    return $response;




           }

           else{
            $us = $em->getRepository(Entreprise::class)->findOneBy(array('email' => $result['email']));
              // dd($us);
              if($us){
                  //entreprise exist
                 // dd('entreprise exist');
                 $response = new Response();
                 $response->setContent(json_encode(array(
                     'result' => 'entreprise already exist !',
                 )));
                 $response->setStatusCode(400    );
                 $response->headers->set('Content-Type', 'application/json');
                 return $response;



              }
              else{
                  //entreprise not exist
                  dd('entreprise not exist');



              }




              




           }



        }
    
        return new Response();
    }


    /**
     * @Route("/getusers",name="get_users",methods={"get"})
     */
    public function getAllUsers(){
        $em = $this->container->get('doctrine')->getManager();

        $us = $em->getRepository(Entreprise::class)->findUser();
        
        $serializer = $this->container->get('serializer');
         $itemSerializer = $serializer->serialize($us, 'json');
       // dd($itemSerializer);
         return new Response( $itemSerializer );
     // $response = new Response($itemSerializer );
       //  $response->setContent( $itemSerializer);
      //   $response->setStatusCode(200    );
     // $response->headers->set('Content-Type', 'application/json');
//  return $response;
       // return new Response();
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



