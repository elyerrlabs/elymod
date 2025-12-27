<?php

namespace {{ Module }}\App\Http\Controllers;

use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends WebController
{
    public function home()
    {
        return Inertia::render("Admin");
    }
}
