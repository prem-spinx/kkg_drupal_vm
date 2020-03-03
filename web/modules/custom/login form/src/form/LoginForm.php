<?php

namespace Drupal\login_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Database\Database;
use Drupal\Core\Url;


class LoginForm extends FormBase {

  public function getFormId() {
    return 'login_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // TODO: Implement buildForm() method.
    $form['user_name'] = [
      '#type' => 'textfield',
      '#title' => t('User Name:'),
      '#required' => TRUE,
    ];
    $form['password'] = [
      '#type' => 'password',
      '#title' => t('Password'),
      '#description' => t('Please enter your password'),
      '#size' => 32,
      '#maxlength' => 32,
      '#required' => TRUE,
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;

  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $field = $form_state->getValues();
    $uname = $field['user_name'];
    $upass = $field['password'];

    $query = \Drupal::database()->select('users_field_data', 'm');
    $query->fields('m', ['uid','name','pass']);
    $results = $query->execute()->fetchAll();
    foreach($results as $data){
      $rows[] = array(
        'id' =>$data->uid,
        'user name' => $data->name,
        'password' => $data->pass,
      );
//      if($uname == $rows[1] [name] && $upass == $rows[1] [pass])
//      {
//        dump($rows);
//        exit;
//      }
      dump( $rows[1] [name]);
    }


  }

}
