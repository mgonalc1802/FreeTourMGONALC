<?php

namespace App\Repository;

use App\Entity\Ruta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ruta>
 *
 * @method Ruta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ruta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ruta[]    findAll()
 * @method Ruta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RutaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ruta::class);
    }

    public function findById($id): array
    {
        return $this->createQueryBuilder('r')
                    ->andWhere('r.id = :val')
                    ->setParameter('val', $id)
                    ->getQuery()
                    ->getResult()
        ;
    }

    public function findByTitulo($titulo): array
    {
        return $this->createQueryBuilder('r')
                    ->andWhere('r.titulo = :val')
                    ->setParameter('val', $titulo)
                    ->getQuery()
                    ->getResult()
        ;
    }

    public function findByItemLocalidad($localidad): array
    {
        return $this->createQueryBuilder('r')
                    ->join('r.item', 'i') //Unir la tabla Item con el alias 'i'
                    ->join('i.localidad', 'l') // Unir la tabla Localidad con el alias 'l'
                    ->andWhere("l.nombre LIKE :localidad")
                    ->setParameter('localidad', $localidad)
                    ->getQuery()
                    ->getResult()
        ;
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('r')
                    ->andWhere('r.fechaFin > :fec')
                    ->setParameter('fec', new \DateTime())
                    ->getQuery()
                    ->getResult()
        ;
    }

    
//    /**
//     * @return Ruta[] Returns an array of Ruta objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ruta
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
