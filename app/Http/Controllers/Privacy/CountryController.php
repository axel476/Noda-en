<?php

namespace App\Http\Controllers\Privacy;

use App\Http\Controllers\Controller;
use App\Models\Privacy\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();
        return view('privacy.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('privacy.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'iso_code' => 'required|unique:' . Country::class . ',iso_code|max:10',
            'name' => 'required|max:255',
        ]);

        Country::create($request->all());

        return redirect()
            ->route('privacy.countries.index')
            ->with('success', 'País creado correctamente');
    }

    public function edit(Country $country)
    {
        return view('privacy.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'iso_code' => 'required|unique:' . Country::class . ',iso_code,' . $country->country_id . ',country_id|max:10',
            'name' => 'required|max:255',
        ]);

        $country->update($request->all());

        return redirect()
            ->route('privacy.countries.index')
            ->with('success', 'País actualizado correctamente');
    }

    public function destroy(Country $country)
    {
        try {
            $country->delete();
            return back()->with('success', 'País eliminado');
        } catch (\Exception $e) {
            return back()->with('error', 'No se puede eliminar, está en uso');
        }
    }
}