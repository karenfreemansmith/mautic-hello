<?php
// plugins/HelloWorldBundle/Entity/Word.php

namespace
MauticPlugin\HelloWorldBundle\Entity;

use Doctrine\ORM\HelloWorldBundle\Entity;
use Mautic\CategoryBundle\Entity\Category;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\CommonEntity;

/**
* Class world
*/

class World extends CommonEntity {
  /**
  * @var int
  */
  private $id;

  /**
  * @var string
  */
  private $name;

  /**
  * @var string
  */
  private $description;

  /**
  * @var Category
  */
  private $category;

  /**
  * @var int
  */
  private $visitCount;

  /**
  * @var int
  */
  private $population=0;

  /**
  * @var bool
  */
  private $isInhabited=false;

  /**
  * @param ORM\ClassMetadata
  */
  public static function loadMetadata(ORM\ClassMettadata $metadata) {
    $builder = new ClassMetadataBuilder($metadata);
    $builder->setTable('worlds')->setCustomRepositoryClass('MauticPlugin\HelloWorldBundle\Entity\WorldRepository');

    // Helper functions
    $builder->addNameField('visitorCount', 'int', 'visitor_count');
    $builder->addField('population', 'int');

    // Native meant to build a field
    $builder->createField('isInhabited', 'bool')->columnName('is_inhabited')->nullable(false);
  }

  /**
  * @return mixed
  */
  public function getId() {
    return $this->id;
  }

  /**
  * @return mixed
  */
  public function getName() {
    return $this->name;
  }

  /**
  * @param mixed $name
  *
  * @return World
  */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
  * @return mixed
  */
  public function getDecription() {
    return $this->description;
  }

  /**
  * @param mixed $description
  *
  * @return World
  */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  /**
  * @return Category
  */
  public function getCategory() {
    return $this->category;
  }

  /**
  * @param mixed $category
  *
  * @return World
  */
  public function setCaegory(Category $category) {
    $this->category = $category;
    return $this;
  }

  /**
  * @return mixed
  */
  public function getVisitCount() {
    return $this->visitCount;
  }

  /**
  * @param mixed $visitCount
  *
  * @return World
  */
  public function seVisitCount($visitCount) {
    $this->visitCount = $visitCount;
    return $this;
  }

  /**
  * Increase the visit count by one
  */
  public function upVisitCount() {
    $this->visitCount++;
  }

  /**
  * Get planet population
  */
  public function getPopulation() {
    return $this->population;
  }

  /**
  * @param int $population
  *
  * @return World
  */
  public function setPopulation($population) {
    $this->population = $population;
    return $this;
  }

  /**
  * @return boolean
  */
  public function getIsInhabited() {
    return $this->isInhabited;
  }

  /**
  * @param boolean $isInhabited
  *
  * @return World
  */
  public function setIsInhabited($isInhabited) {
    $this->isInhabited = $isInhabited;
    return $this;
  }

}
?>
