<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User as UserModel;
use App\Utils\Login;

class LoginController extends Controller
{
  public function index()
  {
    Login::redirectLoggedInUserToTheHomepage();

    $data = [
      'loginMessage' => $_SESSION['message'] ?? null
    ];
    $this->render('login', $data);

    unset($_SESSION['message']);
  }

  public function verify()
  {
    $userModel = new UserModel;
    $loginUrl = BASE_URL . '/login';

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');

    function addMessageToTheSessionAndRedirect(string $message, string $url)
    {
      $_SESSION['message'] = $message;
      header("Location: {$url}");
      exit;
    }

    $hasEmptyFields = empty($email) || empty($password);
    if ($hasEmptyFields) {
      addMessageToTheSessionAndRedirect('Preencha todos os campos', $loginUrl);
    }

    $user = $userModel->findBy(['email' => $email]);

    if (!$user) {
      addMessageToTheSessionAndRedirect('Esta conta não existe.', $loginUrl);
    }

    $userPassword = $user['password'];

    $invalidPassword = !password_verify($password, $userPassword);
    if ($invalidPassword) {
      addMessageToTheSessionAndRedirect('Senha incorreta.', $loginUrl);
    }

    $_SESSION['userId'] = $user['id'];

    header('Location: ' . BASE_URL);
    exit;
  }
}
