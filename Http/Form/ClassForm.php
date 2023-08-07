<?php

namespace Http\Form;

use Core\Validator;

class ClassForm extends Form
{
  public function __construct($attributes)
  {
    parent::__construct($attributes);

    if (!Validator::string($attributes['class_name'], 4, 255)) {
      $this->errors['class_name'] = "Class cannot be blank.";
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
