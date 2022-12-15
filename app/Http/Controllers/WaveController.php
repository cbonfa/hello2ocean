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
    public function index(Request $request)
    {
        // get all the sharks
        $search = $request->input('search');

        
        if (!blank($search)) {
            $waves = Wave::where('name','LIKE','%'.$search.'%')
                        ->orWhere('description', 'LIKE', '%'.$search.'%')
                        ->paginate(50);
        } else {
            $waves = Wave::latest()->paginate(50);
        }
        // load the view and pass the sharks

        return view('hydrosphere.waves.index',compact('waves'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create()
    {
        return view('hydrosphere.waves.create')->with('languages', $this->languages);
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'language_id' => 'required',
        ]);
        // sem o ALL tem que colocar no validate
        $show = Wave::create($request->all());
   
        return redirect()->route('hydrosphere.waves.index')->with('success', 'Wave is successfully saved');
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show(Wave $wave)
    {
        return view('hydrosphere.waves.show',compact('wave'));
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit(Wave $wave)
    {
        // $wave = wave::findOrFail($id);

        return view('hydrosphere.waves.edit', compact('wave'))->with('languages', $this->languages);
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update(Request $request, Wave $wave)
    {
        $request->validate([
            'name' => 'required|max:255',
            'language_id' => 'required',
        ]);
        //         
        $wave->update($request->all());
        //         
        return redirect()->route('hydrosphere.waves.show', compact('wave'))
        ->with('success','Wavez updated successfully');
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy(Wave $wave)
    {
        $wave->delete();
        return redirect()->route('hydrosphere.waves.index')->with('success','Wave deleted successfully');
    }

    public function search(Request $request)
    {
        $waves = Wave::limit(6)->get()->transform(fn($user) => [
            'id' => $user->id,
            'title' => $user->name,
            'subtitle' => $user->email
         ]); 
         return response()->json($waves);
    }

    public function load_variables()
    {
        
        $this->languages = Language::all();
    }
}
