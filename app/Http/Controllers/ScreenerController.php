<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;

class ScreenerController extends Controller {
    public function screen() {
        dd(Http::fmg()->get('/search?query=AA'));
    }
}
