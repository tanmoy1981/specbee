<?php

namespace Drupal\specbee_block\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure specbee_block settings for this site.
 */
class SpecbeeSettingsForm extends ConfigFormBase {
  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'specbee_block.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'specbee_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
    ];

    $form["timezone"] = [
      "#type" => "select",
      "#title" => t("Select your timezone"),
      "#default_value" => $config->get("timezone", "America/Chicago"),
      "#options" => [
        "America/Chicago" => t("America/Chicago"),
        "America/New_York" => t("America/New_York"),
        "Asia/Tokyo" => t("Asia/Tokyo"),
        "Asia/Dubai" => t("Asia/Dubai"),
        "Asia/Kolkata" => t("Asia/Kolkata"),
        "Europe/Amsterdam" => t("Europe/Amsterdam"),
        "Europe/Oslo" => t("Europe/Oslo"),
        "Europe/London" => t("Europe/London"),
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable(static::SETTINGS)
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
