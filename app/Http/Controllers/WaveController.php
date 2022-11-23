<?php

namespace App\Http\Controllers;

use App\Models\Wave;
use Illuminate\Http\Request;

class WaveController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        // get all the sharks
        $waves = Wave::all();

        // load the view and pass the sharks
        return view('hydrosphere.waves.index')
                ->with('waves', $waves);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create()
    {
        return view('hydrosphere.waves.create');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store()
    {
        //
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show($id)
    {
        //
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit($id)
    {
        //
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update($id)
    {
        //
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy($id)
    {
        //
    }
}
