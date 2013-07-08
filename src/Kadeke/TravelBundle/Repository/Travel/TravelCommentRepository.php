<?php

namespace Kadeke\TravelBundle\Repository\Travel;

use Doctrine\ORM\EntityRepository;

/**
 * TravelCommentRepository
 */
class TravelCommentRepository extends EntityRepository
{

    /**
     * Returns a list of TravelComments with the TravelPage's NodeTranslation as parent
     * Ordered by ascending created datetime
     *
     * @param $id int
     *
     * @return array
     */
    public function findByTravelPage($id)
    {
        $travelPageRepository = $this->_em->getRepository('KadekeTravelBundle:Travel\TravelPage');
        $travelpage = $travelPageRepository->find($id);

        $nodeTranslationRepository = $this->_em->getRepository('KunstmaanNodeBundle:NodeTranslation');
        $nodetranslation = $nodeTranslationRepository->getNodeTranslationFor($travelpage);

        return $this->findBy(array('parent' => $nodetranslation->getId()), array('created' => "ASC"));
    }

}
