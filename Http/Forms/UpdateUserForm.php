<?php

namespace Http\Forms;

use Core\Validator;
use Http\Enums\UserType;

class UpdateUserForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);

        if (!Validator::not_empty($username)) {
            $this->errors["username"] = "User's username is required.";
        }
        if (!Validator::not_empty($email)) {
            $this->errors["email"] = "User's email is required.";
        }
        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "Atleast one image is required.";
        }
        if (!Validator::in_options($type, UserType::toArray())) {
            $this->errors["type"] = "Please provide a valid option";
        }
    }
}
