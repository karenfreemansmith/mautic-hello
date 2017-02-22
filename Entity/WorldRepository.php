<?php
// plugins/HelloWorldBundle/Entity/WorldRespository.php

namespace MauticPlugin\HelloWorldBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;

/**
* WorldRespository
*/
class WorldRepository extends CommonRepository {
  public function getEntities($args = array()) {
    $q = $this->createQueryBuilder('w')->leftJoin('a.category', 'c');
    $args['qb'] = $q;
    return parent::getEntitites($args);
  }
}
 ?>
