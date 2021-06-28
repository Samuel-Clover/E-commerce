<?php

namespace App\Controllers;

use App\Core\Controller;

class LogoutController extends Controller {
  public function index()
  {
    $isTheUserLoggedIn = $_SESSION['userId'] ?? false;
    if ($isTheUserLoggedIn) {
      session_destroy();
    }

    header('Location: ' . BASE_URL);
    exit;
  }
}
