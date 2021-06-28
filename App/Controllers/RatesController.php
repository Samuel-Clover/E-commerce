<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Rate as RateModel;

class RatesController extends Controller
{
  public function store()
  {
    $userId = (int) $_SESSION['userId'];
    $productId = (int) filter_input(INPUT_POST, 'productId', FILTER_SANITIZE_NUMBER_INT) ?? null;
    $reviewPoints = (int) filter_input(INPUT_POST, 'stars', FILTER_SANITIZE_NUMBER_INT) ?? null;
    $reviewComment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING) ?? null;

    $emptyFields = empty($productId) || empty($reviewPoints) || empty($reviewComment);
    if ($emptyFields) {
      exit('Você não pode enviar uma avaliação vazia.');
    }

    $rateModel = new RateModel;
    $rateModel->id_user = $userId;
    $rateModel->id_product = $productId;
    $rateModel->points = $reviewPoints;
    $rateModel->comment = $reviewComment;

    $rateModel->save();

    exit('Avaliação enviada com sucesso.');
  }
}
