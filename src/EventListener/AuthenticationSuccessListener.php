<?php


namespace App\EventListener;
use App\Entity\Entreprise;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthenticationSuccessListener
{
    private $container;
    private $em;

    /**
     * AuthenticationSuccessListener constructor.
     */
    public function __construct(
        ContainerInterface $container

    )
    {
        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {

        $data = $event->getData();
        $user = $event->getUser();
        

        if (!$user instanceof Entreprise) {
            return;
        }
        $data['user'] = array(
            'id' => $user->getId(),
            'roles' => $user->getRoles(),
            'email'=>$user->getEmail()

        );
       

        $event->setData($data);
    }
}