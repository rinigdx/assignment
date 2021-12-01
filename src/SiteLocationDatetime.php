<?php

/**
 * @file
 * Contains Service to return date and time based on timezone.
 */

namespace Drupal\site_location;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Component\Datetime\Time;
use Drupal\Core\Datetime\DateFormatter;

/**
 * Service to return date and time.
 */
class SiteLocationDatetime {
  
  /**
   * The config object.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  private $config_factory;

  /**
   * The time object.
   *
   * \Drupal\Component\Datetime\Time
   */
  private $time;

  /**
   * The date formatter object.
   *
   * \Drupal\Core\Datetime\DateFormatter
   */
  private $date_formatter;

  /**
   * Constructs SiteLocationDatetime.
   *
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   An instance of the "config.factory" service.
   * @param \Drupal\Component\Datetime\Time $time
   *   An instance of the "time" service.
   * @param \Drupal\Core\Datetime\DateFormatter $date_formatter
   *   An instance of the "date_formatter" service.
   */
  public function __construct(
    ConfigFactory $config_factory, 
    Time $time, 
    DateFormatter $date_formatter
  ) {
    $this->config_factory = $config_factory;
    $this->time = $time;
    $this->date_formatter = $date_formatter;
  }

  /**
   * Returns the current time based on the timezone selected by the user.
   *
   * @return string
   *   The formatted date time.
   */
  public function getDatetime() {
    $timezone = $this->config_factory->get('site_location.settings')->get('timezone');
    $current_time = $this->time->getCurrentTime();
    $format = 'jS M Y - g:i A';
    return $this->date_formatter->format($current_time, 'custom', $format, $timezone);
  }
}