<?php

namespace Drupal\login_mail\Event;

use Drupal\Component\EventDispatcher\Event;
use Drupal\user\UserInterface;

class UserLoginEvent extends Event {
  const EVENT_NAME = 'login_mail_user_login';
  public $account;

  public function __construct(UserInterface $account) {
    $this->account = $account;
  }
}
