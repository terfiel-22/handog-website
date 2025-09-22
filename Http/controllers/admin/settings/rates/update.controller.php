<?php

use Core\App;
use Http\Models\Rates;

unset($_POST["_method"]);

App::resolve(Rates::class)->updateRates($_POST);

redirect('/admin/settings/rates');
