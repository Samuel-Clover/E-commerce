<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User as UserModel;
use App\Utils\Login;
use App\Utils\Validator;

class RegistrationController extends Controller
{
  public function index()
  {
    Login::redirectLoggedInUserToTheHomepage();

    $data = [
      'registrationMessage' => $_SESSION['message'] ?? null
    ];
    $this->render('cadastro', $data);

    unset($_SESSION['message']);
  }

  public function verify()
  {
    $userModel = new UserModel;
    $registrationUrl = BASE_URL . '/cadastro';

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);
    $phoneNumber = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    function addMessageToTheSessionAndRedirect(string $message, string $url)
    {
      $_SESSION['message'] = $message;
      header("Location: {$url}");
      exit;
    }

    $emptyFields = empty($name)
      || empty($email)
      || empty($password1)
      || empty($password2)
      || empty($phoneNumber)
      || empty($address);
    if ($emptyFields) {
      addMessageToTheSessionAndRedirect(
        'Preencha todos os campos.',
        $registrationUrl
      );
    }

    $userAlreadyExists = $userModel->findBy(['email' => $email]);
    if ($userAlreadyExists) {
      addMessageToTheSessionAndRedirect(
        'Já existe uma conta com este endereço de e-mail.',
        $registrationUrl
      );
    }

    $invalidEmail = !Validator::isAValidEmail($email);
    if ($invalidEmail) {
      addMessageToTheSessionAndRedirect('E-mail inválido.', $registrationUrl);
    }

    $invalidPasswordLength = !Validator::hasAValidPasswordLength($password1);
    if ($invalidPasswordLength) {
      addMessageToTheSessionAndRedirect(
        'A senha deve possuir entre 8 e 50 carácteres.',
        $registrationUrl
      );
    }

    $differentPasswords = !Validator::areThePasswordsTheSame($password1, $password2);
    if ($differentPasswords) {
      addMessageToTheSessionAndRedirect('As senhas não coincidem.', $registrationUrl);
    }

    $invalidPhoneNumber = !Validator::isAValidPhoneNumber($phoneNumber);
    if ($invalidPhoneNumber) {
      addMessageToTheSessionAndRedirect('Número de telefone inválido.', $registrationUrl);
    }

    $hashedPassword = password_hash($password1, PASSWORD_BCRYPT);

    $userModel->name = $name;
    $userModel->password = $hashedPassword;
    $userModel->email = $email;
    $userModel->phone = $phoneNumber;
    $userModel->address = $address;

    $userModel->save();

    $insertedUser = $userModel->findBy(['email' => $email]);
    $userId = $insertedUser['id'];

    $_SESSION['userId'] = $userId;
    header('Location: ' . BASE_URL);
    exit;
  }
}
