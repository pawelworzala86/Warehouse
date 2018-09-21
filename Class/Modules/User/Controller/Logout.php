<?php

namespace App\Modules\User\Controller;

use App\Controller;
use App\User;
use App\Company;
use App\Werhouse;

class Logout extends Controller {

    public function __construct() {
        User::setId(null);
        User::setSuperAdmin(null);
        User::setCurrency(null);
        Company::setId(null);
        Werhouse::setId(null);
        
        header('Location: /');
    }

    public function __invoke() {
    }

}
