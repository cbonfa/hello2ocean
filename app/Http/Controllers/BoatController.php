<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $net = auth()->user()->net;
        return view('boat', compact('net'));
    }

}
