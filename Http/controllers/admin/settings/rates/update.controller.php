<?php

use Core\App;
use Http\Forms\RatesForm;
use Http\Models\Rates;

RatesForm::validate($_POST);

unset($_POST["_method"]);
$_POST["senior_pwd_discount"] = $_POST["senior_pwd_discount"] / 100;

App::resolve(Rates::class)->updateRates($_POST);

redirect('/admin/settings/rates');
