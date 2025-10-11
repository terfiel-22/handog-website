<?php

namespace Http\Forms;

use Core\Validator;

class GalleryImageForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);


        if (!Validator::not_empty($name)) {
            $this->errors["name"] = "Image name is required.";
        }

        if (!Validator::not_empty($description)) {
            $this->errors["description"] = "Image description is required.";
        }

        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "An image is required.";
        }
    }
}
