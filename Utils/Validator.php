<?php

namespace App\Utils;

class Validator
{
  static function isAValidEmail(string $email)
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  static function isAValidPhoneNumber(string $phoneNumber)
  {
    $phoneNumberRegex = '/^\(?\d{1,2}\)? ?9? ?\d{4}-?\d{4}$/';
    return preg_match($phoneNumberRegex, $phoneNumber);
  }

  static function hasAValidPasswordLength(string $password)
  {
    $minPasswordLength = 8;
    $maxPasswordLength = 50;
    return (strlen($password) > $minPasswordLength ||
      strlen($password) < $maxPasswordLength);
  }

  static function areThePasswordsTheSame($password1, $password2)
  {
    return $password1 === $password2;
  }
}
