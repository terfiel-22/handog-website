<?php

namespace Http\Forms;

class LoginForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);
    }
}
