<?php

/**
 * @file
 * Provide views data for exercise1 module.
 */

/**
 * Implements hook_views_data().
 */
function exercise1_views_data() {
  $data = [];
  // Base table.
  $data['user_data']['table']['group'] = t('User Data');
  $data['user_data']['table']['base'] = [
    'title' => t('User Data'),
    'help' => t('Display user data like name, username, email, phone and website.'),
    'query_id' => 'user_data',
  ];

  // Fields for User Data.
  // Full Name.
  $data['user_data']['name'] = [
    'title' => t('Name'),
    'help' => t('Name.'),
    'field' => [
      'id' => 'standard',
    ],
  ];
  // User Name.
  $data['user_data']['user_name'] = [
    'title' => t('UserName'),
    'help' => t('User Name.'),
    'field' => [
      'id' => 'standard',
    ],
  ];

  // User Email.
  $data['user_data']['email'] = [
    'title' => t('Email'),
    'help' => t('Email.'),
    'field' => [
      'id' => 'standard',
    ],
  ];

  // User Phone.
  $data['user_data']['phone'] = [
    'title' => t('Phone'),
    'help' => t('Phone.'),
    'field' => [
      'id' => 'standard',
    ],
  ];

  // User Website.
  $data['user_data']['website'] = [
    'title' => t('Website'),
    'help' => t('Website.'),
    'field' => [
      'id' => 'standard',
    ],
  ];

  return $data;
}
