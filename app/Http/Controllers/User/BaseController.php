<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Helper;

class BaseController extends Controller {
    public $helper;

    public function __construct(Helper $helper) {
        $this->helper = $helper;
    }
}
