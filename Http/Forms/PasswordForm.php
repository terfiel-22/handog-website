<?php

namespace Http\Forms;

use Core\Validator;

class PasswordForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::password($password)) {
            $this->errors["password"] = "Password must contain at least 8 characters, one uppercase letter, one number and one special character.";
        }
        if (!Validator::password_match($password, $cpassword)) {
            $this->errors["cpassword"] = "Password confirmation does not matched.";
        }
    }
}
