<?php

namespace App\Http\Controllers;

use App\Models\Wave;
use App\Models\Language;
use Illuminate\Http\Request;

class WaveController extends Controller
{

    protected $languages;

    public function __construct()
    {
        $this->load_variables();
    }

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
        return view('hydrosphere.waves.create')->with('languages', $this->languages);;
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => '',
            'language_id' => 'required',
        ]);
        $show = Wave::create($validatedData);
   
        return redirect()->route('hydrosphere.waves.index')->with('success', 'Wave is successfully saved');
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
        $wave = wave::findOrFail($id);

        return view('edit', compact('wave'));
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

    public function load_variables()
    {
        
        $this->languages = Language::all();
    }
}
