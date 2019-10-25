<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('brands.index',  compact('brands'));
    }

    public function create()
    {
        $this->authorize('create', Brand::class);

        $brands = Brand::paginate(7);

        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Brand::class);

        $validatedRequest = $request->validate([
            'name' => 'string|min:3|max:50|required',
            'description' => 'string|min:5|required',
            'logo' => 'image|required',
            'color' => 'string|min:7|required'
        ]);

        Brand::create([
            'name'        => $validatedRequest['name'],
            'description' => $validatedRequest['description'],
            'logo'        => '/storage/' . $validatedRequest['logo']->store('/brands', 'public'),
            'color'       => $validatedRequest['color']
        ]);

        return redirect()->back();
    }

    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        $this->authorize('update', $brand);

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        $validatedUpdatedAttributes = $request->validate([
            'name' => 'string|min:3|max:50|required',
            'description' => 'string|min:5|required',
            'color' => 'string|min:7|required'
        ]);

        $brand->update($validatedUpdatedAttributes);

        return redirect()->back();
    }

    public function updateLogo(Request $request, Brand $brand)
    {
        $this->authorize('update', $brand);

        Storage::disk('public')->delete($brand->logo);
        $validatedLogo = $request->validate(['logo' => 'image|required']);
        $brand->update([
            'logo' => '/storage/' . $validatedLogo['logo']->store('brands/', 'public')
        ]);

        return redirect()->back();
    }

    public function destroy(Brand $brand)
    {
        $this->authorize('delete', $brand);
        $brand->delete();

        return redirect()->back();
    }
}
