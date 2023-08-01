<?php

namespace Http\Form;

use Core\Validator;

class LoginForm extends Form
{
  public function __construct($attributes)
  {
    parent::__construct($attributes);
    if (!Validator::email($attributes['email'])) {
      $this->errors['email'] = 'This field cannot be empty.';
    }

    if (!Validator::string($attributes['password'])) {
      $this->errors['password'] = 'This field cannot be empty.';
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
