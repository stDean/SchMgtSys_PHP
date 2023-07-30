<?php

namespace Http\Form;

use Core\ValidationException;
use Core\Validator;

abstract class Form
{
  protected $errors = [];

  public function __construct(public array $attributes)
  {
    if (!Validator::email($attributes['email'])) {
      $this->errors['email'] = "Please provide a valid email address";
    }

    if (!Validator::string($attributes['first_name'], 4, 255)) {
      $this->errors['first_name'] = "First name cannot be blank.";
    }


    if (!Validator::string($attributes['last_name'], 4, 255)) {
      $this->errors['last_name'] = "Last name cannot be blank.";
    }

    if (!Validator::isGender($attributes['gender'])) {
      $this->errors['gender'] = "Gender cannot be empty.";
    }

    if (!Validator::isRank($attributes['role'])) {
      $this->errors['role'] = "A rank must be selected.";
    }

    if (!Validator::string($attributes['password'], 6, 255)) {
      $this->errors['password'] = "Please enter password with 6 or more characters.";
    }

    if ($attributes['password'] !== $attributes['cfPassword']) {
      $this->errors['password'] = "Password don't match";
    }
  }

  abstract public static function validate($attributes);

  public function throw()
  {
    ValidationException::throw($this->errors(), $this->attributes);
  }

  protected function failed()
  {
    // dd($this->errors);
    return count($this->errors);
  }

  protected function errors()
  {
    return $this->errors;
  }

  public function error($field, $msg)
  {
    $this->errors[$field] = $msg;
    return $this;
  }
}
