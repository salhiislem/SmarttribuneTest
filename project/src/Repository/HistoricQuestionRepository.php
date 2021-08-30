<?php
// /src/Repository/HistoricQuestionRepository.php
namespace App\Repository;

use App\Entity\Historicquestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Historicquestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Historicquestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Historicquestion[]    findAll()
 * @method Historicquestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoricQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Historicquestion::class);
    }

    
}