<?php

namespace Drupal\exercise1\Plugin\views\query;

use Drupal\views\ResultRow;
use Drupal\views\ViewExecutable;
use Drupal\exercise1\GetUserData;
use Drupal\views\Plugin\views\query\QueryPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * UserData views query plugin which wraps calls to the user data API
 * in order to expose the results to views.
 *
 * @ViewsQuery(
 *   id = "user_data",
 *   title = @Translation("UserData"),
 *   help = @Translation("Query against the UserData API.")
 * )
 */
class UserData extends QueryPluginBase {

  /**
   * UserData constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\exercise1\GetUserData $userdata_client
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, GetUserData $userdata_client) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->getUserData = $userdata_client;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('exercise1.get_user_data'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function ensureTable($table, $relationship = NULL) {
    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function addField($table, $field, $alias = '', $params = []) {
    return $field;
  }

  /**
   * {@inheritdoc}
   */
  public function execute(ViewExecutable $view) {
    if (!empty($userData = $this->getUserData->getUserDataFromApi())) {
      $index = 0;
      foreach ($userData as $key => $val) {
        $row['name'] = $val['name'];
        $row['user_name'] = $val['username'];
        $row['email'] = $val['email'];
        $row['phone'] = $val['phone'];
        $row['website'] = $val['website'];
        $row['index'] = $index++;
        $view->result[] = new ResultRow($row);
      }
    }
  }

}
