<?php

/**
 * @file
 * Contains Drupal\site_location\Form
 */

namespace Drupal\site_location\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Site Location Settings form.
 */
class LocationSettingsForm extends ConfigFormBase {

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'site_location.settings',
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'site_location_admin_settings';
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('site_location.settings');
    $options = [
      'default' => 'Select a Timezone',
      'America/Chicago' => 'America/Chicago',
      'America/New_York' => 'America/New_York',
      'Asia/Tokyo' => 'Asia/Tokyo',
      'Asia/Dubai' => 'Asia/Dubai',
      'Asia/Kolkata' => 'Asia/Kolkata',
      'Europe/Amsterdam' => 'Europe/Amsterdam',
      'Europe/Oslo' => 'Europe/Oslo',
      'Europe/London' => 'Europe/London'
    ];

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => 'Country',
      '#default_value' => $config->get('country')
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => 'City',
      '#default_value' => $config->get('city')
    ];

    $form['timezone'] = [
      '#type' => 'select',
      '#title' => 'Timezone',
      '#options' => $options,
      '#default_value' => $config->get('timezone')
    ];

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('site_location.settings')
      ->set('country', $form_state->getValue('country'))
      ->save();

    $this->config('site_location.settings')
      ->set('city', $form_state->getValue('city'))
      ->save();

    $this->config('site_location.settings')
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}