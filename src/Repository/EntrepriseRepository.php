<?php

namespace App\Repository;

use App\Entity\Entreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }

    // /**
    //  * @return Entreprise[] Returns an array of Entreprise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entreprise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
//T5DEM NAFES L5EDMA MTA3 FINDALL CHNRAJ3OU LI DONNEE

    public function findUser(): array
    {
       
        //l querybuilder ya3ml les requete sql 3malna methode u
        $qb = $this->createQueryBuilder('u')
        ->select('u.email,u.adresse,u.categorie,u.siteweb,u.login,u.numtel,u.domaineAct,u.nomEnp,u.logo,u.typeEnp');
        //,u.domaine_act,u.type_enp
        //

          //  ->where('webservice.baseUrl Like :url')
            //->andWhere('webservice.user = :user')
            //->setParameter('url', $url)
           // ->setParameter('user', $user);


        $query = $qb->getQuery();

        return $query->execute();

        // to get just one result:
        //
    } 




}
