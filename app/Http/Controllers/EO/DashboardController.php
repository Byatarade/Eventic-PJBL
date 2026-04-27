<?php

namespace App\Http\Controllers\EO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the EO dashboard.
     */
    public function index(): View
    {
        return view('eo.dashboard');
    }
}
