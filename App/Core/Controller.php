<?php

namespace App\Core;

use Twig\Extra\Intl\IntlExtension;
use \Throwable;

abstract class Controller
{
  use Auth\Auth;

  public function render(string $viewName, array $viewData = array()): void
  {
    try {
      extract($viewData);

      $loader = new \Twig\Loader\FilesystemLoader('../App/Views/');
      $twig = new \Twig\Environment($loader);
      $twig->addExtension(new IntlExtension());

      $template = $twig->load($viewName . '.php');
      $run = $template->render($viewData);

      echo $run;
    } catch (Throwable $e) {
      echo 'Error: Não foi encontrado o template';
    }
  }
}
