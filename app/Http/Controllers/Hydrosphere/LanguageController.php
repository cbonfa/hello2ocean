<?php

namespace App\Http\Controllers\Hydrosphere;

use App\Models\Country;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{

    protected $countries;

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
            $languages = Language::where('description','LIKE','%'.$search.'%')
                        ->orderBy('description')
                        ->paginate(50);
        } else {
            $languages = Language::orderBy('description')->paginate(50);
        }
        // load the view and pass the sharks

        return view('hydrosphere.languages.index',compact('languages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create()
    {
        return view('hydrosphere.languages.create')->with('countries', $this->countries);
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:255',
            'country_id' => 'required',
            'locale' => 'required|max:255'
        ]);
        // sem o ALL tem que colocar no validate
        $show = Language::create($request->all());
   
        return redirect()->route('hydrosphere.languages.index')->with('success', __('languages.created_success'));
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show(Language $language)
    {
        return view('hydrosphere.languages.show',compact('language'));
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit(Language $language)
    {
        // $wave = Language::findOrFail($id);

        return view('hydrosphere.languages.edit', compact('language'))->with('countries', $this->countries);
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'description' => 'required|max:255',
            'country_id' => 'required',
            'locale' => 'required|max:255'
        ]);
        //         
        $language->update($request->all());
        // 
        return redirect()->route('hydrosphere.languages.show', compact('language'))
        ->with('success', __('languages.updated_success'));
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('hydrosphere.languages.index')->with('success',__('languages.deleted_success'));
    }

    private function load_variables()
    {
        $this->countries = Country::all();
    }

}
