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
    if (isset($_GET['type'])) {
      if (!Validator::string($attributes['correct_answer'], 1, 255)) {
        $this->errors['correct_answer'] = "answer field cannot be empty.";
      }

      if (isset($_GET['type']) && $_GET['type'] === 'multiple') {
        $num = 0;
        $letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];
        foreach ($_POST as $key => $val) {
          if (strstr($key, 'choice')) {
            if (!Validator::string($val, 1, 255)) {
              $this->errors['choice' . $num] = 'choice ' . $letters[$num] . ' field cannot be empty';
            }
            $num++;
          }
        }
      }
    }
  }

  public static function validate($attributes)
  {
    $instance = new static($attributes);
    return $instance->failed() ? $instance->throw() : $instance;
  }
}
