<?php

namespace App\Core\Auth;

trait Auth
{
  /***
   **@param verificar se usuário esta logado realmente
   **senão tive redirecionar para tela de login
   ***/
  public function middleware(string $value): void
  {
    if (empty($_SESSION['id'])) {
      $this->redirect('login');
    }
  }

  /***
   **@param para redirecionar página
   ***/
  public function redirect(string $name = ''): void
  {
    header('Location:' . BASE_URL . "/{$name}");
    exit;
  }
}
