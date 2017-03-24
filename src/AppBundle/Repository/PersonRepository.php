<?php

namespace AppBundle\Repository;

/**
 * PersonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonRepository extends \Doctrine\ORM\EntityRepository {

    public function searchQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->where("e.fullName like concat('%', :q, '%')");
        $qb->setParameter('q', $q);
        return $qb->getQuery();
    }

    public function fulltextQuery($q) {
        $qb = $this->createQueryBuilder('e');
        $qb->addSelect("MATCH_AGAINST (e.fullName, :q 'IN BOOLEAN MODE') as HIDDEN score");
        $qb->add('where', "MATCH_AGAINST (e.fullName, :q 'IN BOOLEAN MODE') > 0");
        $qb->orderBy('score', 'desc');
        $qb->setParameter('q', $q);
        return $qb->getQuery();
    }

}
