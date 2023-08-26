<?php

namespace Http\Form;

use Core\Validator;

class TestForm extends Form
{
  public function __construct($attributes)
  {
    parent::__construct($attributes);

    if (!Validator::string($attributes['test_name'], 4, 255)) {
      $this->errors['test_name'] = "Test name cannot be blank.";
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
