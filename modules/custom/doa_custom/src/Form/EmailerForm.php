<?php
namespace Drupal\doa_custom\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Class EmailerForm.
 *
 * @package Drupal\doa_custom\Form
 */
class EmailerForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'emailer_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['sync_chat'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Send mail'),
    );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //$sync_list = \Drupal::service('chat.applozic')->createSyncList();

    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('field_email', '', '!=');

  $sync_list = $query->execute();

    $batch = array(
      'title' => t('Sending mail...'),
      'operations' => array(
        array(
          '\Drupal\doa_custom\SendEmail::sendEmail',
          array($sync_list)
        ),
      ),
      'finished' => '\Drupal\doa_custom\SendEmail::sendEmailFinishedCallback',
    );
    batch_set($batch);
  }
}
