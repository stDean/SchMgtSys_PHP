<?php

namespace Http\Form;

use Core\Validator;

class ProfileForm extends Form
{
  public function __construct($attributes)
  {
    parent::__construct($attributes);

    if (!Validator::email($attributes['email'])) {
      $this->errors['email'] = "Please provide a valid email address";
    }

    if (!Validator::string($attributes['first_name'], 4, 255)) {
      $this->errors['first_name'] = "First name cannot be blank.";
    }


    if (!Validator::string($attributes['last_name'], 4, 255)) {
      $this->errors['last_name'] = "Last name cannot be blank.";
    }

    if (!Validator::isRank($attributes['role'])) {
      $this->errors['role'] = "A rank must be selected.";
    }

    if (isset($attributes['password'])) {
      if (!Validator::string($attributes['password'], 6, 255)) {
        $this->errors['password'] = "Please enter password with 6 or more characters.";
      }

      if ($attributes['password'] !== $attributes['cfPassword']) {
        $this->errors['password'] = "Password don't match";
      }
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
