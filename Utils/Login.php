<?php

namespace App\Utils;

class Login
{
  public static function redirectLoggedInUserToTheHomepage()
  {
    $userLoggedIn = $_SESSION['userId'] ?? false;

    if ($userLoggedIn) {
      header('Location: ' . BASE_URL);
      exit;
    }
  }

  public static function redirectNotLoggedInUserToTheHomepage()
  {
    $userLoggedIn = $_SESSION['userId'] ?? false;

    if (!$userLoggedIn) {
      header('Location: ' . BASE_URL);
      exit;
    }
  }
}
