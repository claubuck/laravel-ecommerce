<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('categories', 'public');
        }

        /* Category::create($validatedData); */
        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);



        return redirect()->route('categories.index')->with('success', 'Categoria creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('categories', 'public');
            
            $categories = Category::findOrFail($category->id);
            $categories->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'image' => $imagePath,
            ]);
        } else {
            $categories = Category::findOrFail($category->id);
            $categories->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
        }
        return redirect()->route('categories.index')->with('success', 'Categoria modificada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
