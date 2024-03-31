<?php

namespace Drupal\login_mail\EventSubscriber;

use Drupal\login_mail\Event\UserLoginEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserLoginSubscriber implements EventSubscriberInterface
{
  public static function getSubscribedEvents()
  {
    return [
      UserLoginEvent::EVENT_NAME => 'onUserLogin',
    ];
  }

  public function onUserLogin(UserLoginEvent $event)
  {
    $module = 'login_mail';
    $mailManager = \Drupal::service('plugin.manager.mail');
    $key = 'user_login';
    $to = \Drupal::config('system.site')->get('mail');
    $params['title'] = "「".\Drupal::config('system.site')->get('name')."」にユーザーがログインしました。";
    $params['message'] = "ユーザーがログインしたので、管理者宛にメールを送信します。\n\n";
    $params['message'] .= "-------ログインユーザー情報-------\n";
    $params['message'] .= "ログイン名：".\Drupal::currentUser()->getAccountName()."\n";
    $params['message'] .= "メールアドレス：".\Drupal::currentUser()->getEmail()."\n";
    $params['message'] .= "IPアドレス：".\Drupal::requestStack()->getCurrentRequest()->getClientIp();
    $langcode = \Drupal::config('system.site')->get('langcode');
    $send = true;


    $mailManager->mail($module, $key, $to, $langcode, $params, null, $send);
  }
}
