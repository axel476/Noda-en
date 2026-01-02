<?php

namespace App\Http\Controllers\Privacy;

use App\Http\Controllers\Controller;
use App\Models\Privacy\DataCategory;
use Illuminate\Http\Request;

class DataCategoryController extends Controller
{
    public function index()
    {
        $dataCategories = DataCategory::orderBy('name')->get();
        return view('privacy.data_category.index', compact('dataCategories'));
    }

    public function create()
    {
        return view('privacy.data_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:privacy.data_category,code',
            'name' => 'required',
            'is_sensitive' => 'required|boolean',
        ]);

        DataCategory::create($request->all());

        return redirect()
            ->route('privacy.data_category.index')
            ->with('success', 'Categoría creada correctamente');
    }

    public function edit(DataCategory $data_category)
    {
        return view('privacy.data_category.edit', compact('data_category'));
    }

    public function update(Request $request, DataCategory $data_category)
    {
        $request->validate([
            'code' => 'required|unique:privacy.data_category,code,' . $data_category->data_cat_id . ',data_cat_id',
            'name' => 'required',
            'is_sensitive' => 'required|boolean',
        ]);

        $data_category->update($request->all());

        return redirect()
            ->route('privacy.data_category.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy(DataCategory $data_category)
    {
        try {
            $data_category->delete();
            return back()->with('success', 'Categoría eliminada');
        } catch (\Exception $e) {
            return back()->with('error', 'No se puede eliminar, está en uso');
        }
    }
}
