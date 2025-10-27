<?php

namespace Http\Forms;

use Core\Validator;

class PasswordForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::string($password, 8)) {
            $this->errors["password"] = "Password should at least 8 characters.";
        }
        if (!Validator::password_match($password, $cpassword)) {
            $this->errors["cpassword"] = "Password confirmation does not matched.";
        }
    }
}
