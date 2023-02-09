<?php

namespace App\Http\Controllers\Hydrosphere;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    protected $validates;

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
            $countries = Country::where('name','LIKE','%'.$search.'%')
                        ->orWhere('code','LIKE','%'.$search.'%')
                        ->orderBy('name')
                        ->paginate(50);
        } else {
            $countries = Country::orderBy('name')->paginate(50);
        }
        // load the view and pass the sharks

        return view('hydrosphere.countries.index',compact('countries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create()
    {
        return view('hydrosphere.countries.create');
    }

    /**
        * Store a newly created resource in storage.
        *
        * @return Response
        */
    public function store(Request $request)
    {
        $request->validate($this->validates);
        // sem o ALL tem que colocar no validate
        $show = Country::create($request->all());
   
        return redirect()->route('hydrosphere.countries.index')->with('success', __('country.created_success'));
    }

    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function show(Country $country)
    {
        return view('hydrosphere.countries.show',compact('country'));
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return Response
        */
    public function edit(Country $country)
    {
        // $wave = Country::findOrFail($id);

        return view('hydrosphere.countries.edit', compact('country'));
    }

    /**
        * Update the specified resource in storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function update(Request $request, Country $country)
    {
        $request->validate($this->validates);
        //         
        $country->update($request->all());
        // 
        return redirect()->route('hydrosphere.countries.show', compact('country'))
        ->with('success', __('countries.updated_success'));
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('hydrosphere.countries.index')->with('success',__('country.deleted_success'));
    }

    private function load_variables()
    {
        $this->validates = [
                                'name' => 'required|max:255',
                                'code' => 'required|max:255'
        ];
    }

}
