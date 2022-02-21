<?php

namespace Drupal\specbee_block;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Security\TrustedCallbackInterface;

/**
 * Class CalculateDateTime.
 */
class CalculateDateTime implements TrustedCallbackInterface {
  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $specbee_config;

  /**
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->specbee_config = $config_factory->get('specbee_block.settings');
  }

  /**
   * Trusted callback.
   *
   * @return trusted function name
   */
  public static function trustedCallbacks() {
    return ['getDateTime'];
  }

  /**
   * Returns calculated date and time.
   *
   * @return formatted date and time
   */
  public function getDateTime() {
    $timezone = $this->specbee_config->get('timezone');
    $date = new DrupalDateTime('now', $timezone);

    return [
      '#markup' => $date->format('dS M Y - g:i a'),
    ];
  }

}
