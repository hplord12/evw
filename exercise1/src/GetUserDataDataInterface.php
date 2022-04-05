<?php

namespace Drupal\exercise1;

/**
 * User Data interface.
 */
interface GetUserDataDataInterface {

  /**
   * Get all user data..
   *
   * @return array
   *   An associative array of user data.
   */
  public function getUserDataFromApi();

}
