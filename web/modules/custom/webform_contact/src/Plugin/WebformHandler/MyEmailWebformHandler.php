<?php 

namespace Drupal\webform_contact\Plugin\WebformHandler;

use Drupal\webform\Plugin\WebformHandler\EmailWebformHandler;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Emails a webform submission.
 *
 * @WebformHandler(
 *   id = "local_email",
 *   label = @Translation("Local email"),
 *   category = @Translation("Notification"),
 *   description = @Translation("Sends a webform submission to a different email address per contact."),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 * )
 */
class MyEmailWebformHandler extends EmailWebformHandler {

  public function sendMessage(WebformSubmissionInterface $webform_submission, array $message) {
   $current_path = \Drupal::service('path.current')->getPath();
   $nid = \Drupal::request()->query->get('aid');
   if($nid){
     $node = \Drupal::entityTypeManager()->getStorage('node')->load($nid);
     $email_address = $node->get('field_email_id')->getValue();
    $message['to_mail'] ='';
    $message['to_mail'] = $email_address[0]['value'];
   }

    parent::sendMessage($webform_submission, $message);
  }
}
