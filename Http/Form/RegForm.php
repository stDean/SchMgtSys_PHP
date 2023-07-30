<?php

namespace Http\Form;

class RegForm extends Form
{
  public function __construct($attributes)
  {
    parent::__construct($attributes);
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
