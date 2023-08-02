<?php

namespace Http\Form;

use Core\Validator;

class SchoolForm extends Form
{
  public function __construct($attributes)
  {
    parent::__construct($attributes);

    if (!Validator::string($attributes['schoolname'], 4, 255)) {
      $this->errors['schoolname'] = "School name cannot be blank.";
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
