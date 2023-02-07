<?php

namespace App\Http\Controllers\Boat;

use App\Models\Fisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FisherController extends Controller
{
    public function edit()
    {
        return view('boat.fishers.edit');
    }

}
