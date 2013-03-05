<?php

namespace Kadeke\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BlogCommentRepository
 */
class BlogCommentRepository extends EntityRepository
{

    /**
     * Returns a list of BlogComments with the BlogEntry's NodeTranslation as parent
     * Ordered by ascending created datetime
     *
     * @param $id int
     *
     * @return array
     */
    public function findByBlogEntry($id)
    {
        $blogEntryRepository = $this->_em->getRepository('KadekeBlogBundle:BlogEntry');
        $blogentry = $blogEntryRepository->find($id);

        $nodeTranslationRepository = $this->_em->getRepository('KunstmaanNodeBundle:NodeTranslation');
        $nodetranslation = $nodeTranslationRepository->getNodeTranslationFor($blogentry);

        return $this->findBy(array('parent' => $nodetranslation->getId()), array('created' => "ASC"));
    }

}
