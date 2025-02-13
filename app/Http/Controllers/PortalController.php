<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PortalController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('portal');
    }
}
