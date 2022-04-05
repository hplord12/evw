<?php

namespace Drupal\exercise1;

use GuzzleHttp\ClientInterface;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Cache\CacheBackendInterface;

/**
 * Get the list of users data from API.
 */
class GetUserData implements GetUserDataDataInterface {

  /**
   * The HTTP client to fetch the feed data with.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Cache backend service.
   *
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  protected $cache;

  /**
   * Constructs a GetUserData instance.
   *
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP client.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache
   *   Cache backend.
   */
  public function __construct(ClientInterface $http_client, CacheBackendInterface $cache) {
    $this->httpClient = $http_client;
    $this->cache = $cache;
  }

  /**
   * APi call for getting list of users.
   *
   * @see \Drupal\exercise1\GetUserDataDataInterface::getUserDataFromApi()
   */
  public function getUserDataFromApi() {
    $data = $result = [];
    try {
      // Retrun user data if it is cache.
      if ($cache = $this->cache->get("userdata")) {
        $result = $cache->data;
      }
      else {
        // Call actual api if data is not in cache.
        $data = $this->httpClient->get('https://deelay.me/3000/https://jsonplaceholder.typicode.com/users');
        $result = Json::decode($data->getBody()->getContents());
        $this->cache->set("userdata", $result, strtotime('24 hours'));
      }
    }
    catch (RequestException $e) {
      watchdog_exception('exercise1', $e->getMessage());
    }

    return $result;
  }

}
