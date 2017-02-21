<?php

namespace
MauticPlugin\HelloWorldBundle

use Doctring\DBAL\Schema\Schema;
use Mautic\PluginBundle\Bundle\PluginBundleBase;
use Mautic\PluginBundle\Entity\Plugin;
use Mautic\CoeBundle\Factory\MauticFactory;

class HelloWorldBundle extends PluginBundleBase {
  // make it say "Hello World" somewhere?

  /**
  * Some comments that may also be code?
  * Leaving them out to see if it's breaking... or just documentation
  */

  static public function onPluginInstall(Plugin $plugin, MauticFactory $factory, $metadata = null) {
    // this funtion is called on initial install
    if($metadata !== null) {
      self::installPluginSchema($metadata, $factory);
    }

    // other install tasks as needed
  }

  /**
  * Some comments that may also be code?
  * Leaving them out to see if it's breaking... or just documentation
  */

  static public function onPluginUpdate(Plugin $plugin, MauticFactory $factory, $metadata = null, Schema $installedSchema = null) {
    // this function is called when the plug-in gets updated

    // may also call updatePluginSchema(), but with caution & lots of testing...still, better than asking users to run the command by hand everytime it's updated, is it not?
    // "recommended to write a migration path for both MySQL and PostgreSQL with native queries instead." -- in which case it might be nice to see an example

    $db = $factory->getDatabase();
    $platform = $db->getDatabasePlatform()->getName();
    $queries = array();
    $fromVersion = $plugin->getVersion();

    switch($fromVersion) {
      case '1.0':
        switch($platform) {
          case 'mysql':
            // mysql stuff
            $queries[] = 'ALTER TABLE ' . MAUTIC_TABLE_PREFIX . 'worlds CHANGE description LONGTEXT DEFAULT NULL';
            // CHANGE description was repeated twice and I don't know if that's a typo or some kind of SQL I don't know
            // 'worlds CHANGE CHANGE description description LONGTEXT DEFAULT NULL'
            break;
          case 'postresql':
            $queries[] = 'ALTER TABLE ' . MAUTIC_TABLE_PREFIX . 'worlds ALTER description ALTER TYPE TEXT';
            // postgress stuff - is this the "native migration path"?
            break;
        }
      if(!empty($queries)) {
        $db->beginTransaction();
        try {
          foreach($queries as $q) {
            $db->query($q);
          }
          $db->commit();
        } catch(\Exception $e) {
          $db->rollback();
          throw $e;
        }
      }
    }
  }
}
 ?>
