<?php

namespace Application\UTBM\TOEFLBundle\Repository;

use Application\Sonata\ClassificationBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;

/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends EntityRepository
{

    /**
     * @param array $tags
     * @param int $limit
     * @return array
     */
    public function findAllQuestionByTags( $tags = array(), $limit = 10 ) {
        
        $offset = intval(rand(1, 4));
        $query = $this->createQueryBuilder( "q" );
        $query = $query->select( "q" );
        $query = $query->leftJoin( "q.tags", "t" );

        if( !empty($tags) ) {
            $query->where($query->expr()->in( "t", ":tags" ));
            $query->setParameter( ":tags", $tags );
        }
        if($offset == 1){
            $query = $query->orderBy('q.id','desc');
        }else if($offset == 2){
            $query = $query->orderBy('q.id');
        }else if($offset == 3){
            $query = $query->orderBy('q.title','desc');
        }else{
           $query = $query->orderBy('q.title'); 
        }

        $query->setMaxResults( $limit );

        
        return $query->getQuery()->getResult();
    }

    public function getTagQuestionCount(Tag $tag) {

        $query = $this->createQueryBuilder( "q" );
        $query = $query->select( "count(q)" );
        $query = $query->leftJoin( "q.tags", "t" );

        $query->where($query->expr()->in( "t", ":tag" ));
        $query->setParameter( ":tag", $tag );

        return $query->getQuery()->getSingleScalarResult();
    }

}
