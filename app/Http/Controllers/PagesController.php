<?php

namespace App\Http\Controllers;

/**
 * 首页控制器
 */

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }
}
