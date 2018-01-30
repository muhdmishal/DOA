<?php

namespace Drupal\doa_custom;

class SendEmail {
  public static function sendEmail($sync_list, &$context){
    $message = 'Sending mail...';
    $results = array();
    foreach ($sync_list as $item) {

      // $send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail(); // this is used to send HTML emails
      // $from = ‘from@gmail.com’;
      // $to = ‘to@gmail.com’;
      // $message['headers'] = array(
      // 'content-type' => 'text/html',
      // 'MIME-Version' => '1.0',
      // 'reply-to' => $from,
      // 'from' => 'sender name <'.$from.'>'
      // );
      // $message['to'] = $to;
      // $message['subject'] = "Subject Goes here !!!!!";
      //
      // $message['body'] = 'Hello,
      // Thank you for reading this blog.';
      //
      // $send_mail->mail($message);


      $results[] = True;
    }
    $context['message'] = $message;
    $context['results'] = $results;
  }
  function sendEmailFinishedCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'One mail send.', '@count mails send.'
      );
    }
    else {
      $message = t('Finished with an error.');
    }
    drupal_set_message($message);
  }
}
