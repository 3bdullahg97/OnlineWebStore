<?php

namespace App\Http\Controllers;

use App\Specification;
use Illuminate\Http\Request;

class SpecificationController extends Controller
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
        //
    }

    public function show(Specification $specification)
    {
        //
    }

    public function edit(Specification $specification)
    {
        //
    }

    public function update(Request $request, Specification $specification)
    {
        //
    }

    public function destroy(Specification $specification)
    {
        $this->authorize('delete', $specification);
        $specification->delete();

        return response()->json(["Message" => "true"]);
    }

    public function SpecificationAjaxResponse($groupID)
    {
        $specifications = Specification::where('group_id', '=', $groupID)->get();

        return response()->json($specifications);
    }
}
