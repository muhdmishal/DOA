<?php

namespace Drupal\doa_custom;

class SendEmail {
  public static function sendEmail($sync_list, &$context){
    $message = 'Sending mail...';
    $results = array();
    foreach ($sync_list as $item) {

      $results[] = True;
    }
    $context['message'] = $message;
    $context['results'] = $results;
  }
  function sendEmailFinishedCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.

    $send_mail = new \Drupal\Core\Mail\Plugin\Mail\PhpMail(); // this is used to send HTML emails
    $from = 'info@drivingoffenceadvice.co.uk';
    $to = 'muhdmishal@gmail.com';
    $message['headers'] = array(
    'content-type' => 'text/html',
    'MIME-Version' => '1.0',
    'reply-to' => $from,
    'from' => 'Driving Offence Advice <'.$from.'>'
    );
    $message['to'] = $to;
    $message['subject'] = "List you firm in Driving Offence Advice";

    if(($Content = file_get_contents("https://drivingoffenceadvice.co.uk/list-your-firm")) === false) {
        $Content = "";
    }

    $message['body'] = $Content;

    $send_mail->mail($message);

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
