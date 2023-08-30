<?php

namespace Http\Form;

use Core\Validator;

class QuestionForm extends Form
{
  public function __construct($attributes)
  {
    parent::__construct($attributes);

    if (!Validator::string($attributes['question'], 10, 255)) {
      $this->errors['question'] = "please add a valid question.";
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
