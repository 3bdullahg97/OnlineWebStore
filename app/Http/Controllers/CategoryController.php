<?php

namespace App\Http\Controllers;

use App\Category;
use App\SpecificationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        $categories = Category::paginate(7);

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        $validatedRequest = $request->validate([
            'name' => 'string|min:5|max:50|required',
            'description' => 'string|min:5|required',
            'logo' => 'image|required'
        ]);
        $category = Category::create([
            'name'        => $validatedRequest['name'],
            'description' => $validatedRequest['description'],
            'logo'        => '/storage/' . $validatedRequest['logo']->store('categories/', 'public')
        ]);
        SpecificationGroup::add($request);

        return redirect()->back();
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $validatedRequest = $request->validate([
            'name' => 'string|min:5|max:50|required',
            'description' => 'string|min:5|required',
        ]);

        $category->update([
            'name' => $validatedRequest['name'],
            'description' => $validatedRequest['description']
        ]);

        SpecificationGroup::updateMultipleGroups($request['groups']);

        return redirect()->back();
    }

    public function updateLogo(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        Storage::disk('public')->delete($category->logo);
        $validatedImage = $request->validate([
           'logo' => 'image|required'
        ]);
        $category->update([
            'logo' => '/storage/' .  $validatedImage['logo']->store('categories/', 'public')
        ]);

        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        Storage::disk('public')->delete($category->logo);
        $category->delete();

        return redirect()->back();
    }

    public function CategoryAjaxResponse($id)
    {
        $category = Category::find($id);

        return response()->json($category->specificationGroups);
    }

}
