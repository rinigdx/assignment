<?php

namespace Drupal\site_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\site_location\SiteLocationDatetime;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Site Datetime' block.
 *
 * @Block(
 *   id = "site_datetime_block",
 *   admin_label = @Translation("Site Datetime Block"),
 * )
 */
class SiteDateTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * An instance of the "site_location.datetime" service.
   *
   * @var \Drupal\site_location\SiteLocationDatetime
   */
  protected $site_datetime;

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container, 
    array $configuration, 
    $plugin_id, 
    $plugin_definition
  ) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('site_location.datetime'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration, 
    $plugin_id, 
    $plugin_definition, 
    SiteLocationDatetime $site_datetime
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->site_datetime = $site_datetime;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $time = $this->site_datetime->getDatetime();
    return[
      '#theme' => 'site_datetime',
      '#current_time' => $time,
      '#cache' => [
        'max-age' => 0,
        'contexts' => ['url.site']
      ],
    ];
  }
}