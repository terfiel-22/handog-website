<?php

namespace Http\Forms;

use Core\Validator;

class ForgotPasswordForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);


        if (!Validator::not_empty($email)) {
            $this->errors["email"] = "Email is required.";
        }
    }
}
