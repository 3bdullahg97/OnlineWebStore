<?php

namespace App\Http\Controllers;

use App\SpecificationGroup;
use Illuminate\Http\Request;

class SpecificationGroupController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->authorize('create', SpecificationGroup::class);
        SpecificationGroup::add($request);

        return redirect()->back();
    }

    public function show(SpecificationGroup $specificationGroup)
    {
        //
    }

    public function edit(SpecificationGroup $specificationGroup)
    {
        //
    }

    public function update(Request $request, SpecificationGroup $specificationGroup)
    {
        //
    }

    public function destroy($specificationGroup)
    {
        $this->authorize('delete', $specificationGroup);

        SpecificationGroup::find($specificationGroup)->delete();

        return response()->json(["Message" => "true"]);
    }
}
