<?php
// plugins/HelloWorldBundle/Model/ContactModel.php

namespace
MauticPlugin\HelloWorldBundle\Model;

use Mautic\CoreBundle\Model\CommonModel;

class ContactModel extends CommonModel {
  /**
  * Send contact email
  *
  * @param array $DOMCdataSection
  */

  public function sendContactEmail($data) {
    // Get mailer helper - pass the mautic.helper.mailer service as a dependency
    $mailer = $this->mailer;
    $mailer->message->addTo($this->factory->getParameter('mailer_from_email'));
    $this->message->setForm(array($data['email'] => $data['name']));
    $mailer->message->setSubject($data['subjecct']);
    $mailer->message->setBody($data['message']);
    $mailer->send();
  }
}
?>
