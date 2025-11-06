<?php

namespace Http\Forms;

use Core\Validator;

class FolderForm extends Form
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        extract($this->attributes);


        if (!Validator::not_empty($name)) {
            $this->errors["name"] = "Folder name is required.";
        }

        if (!Validator::not_empty($description)) {
            $this->errors["description"] = "Folder description is required.";
        }

        if (!Validator::not_empty($image)) {
            $this->errors["image"] = "Atleast one image is required.";
        }
    }
}
