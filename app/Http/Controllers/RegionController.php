<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegionController extends Controller
{
    /**
     * Instantiate a new RegionController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-region|edit-region|delete-region', ['only' => ['index','show']]);
       $this->middleware('permission:create-region', ['only' => ['create','store']]);
       $this->middleware('permission:edit-region', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-region', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('regions.index', [
            'regions' => Region::latest('id')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request): RedirectResponse
    {
        Region::create($request->all());
        return redirect()->route('regions.index')
                ->withSuccess('New region is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region): View
    {
        return view('regions.show', [
            'region' => $region
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region): View
    {
        return view('regions.edit', [
            'region' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region): RedirectResponse
    {
        $region->update($request->all());
        return redirect()->back()
                ->withSuccess('region is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region): RedirectResponse
    {
        $region->delete();
        return redirect()->route('regions.index')
                ->withSuccess('Region is deleted successfully.');
    }
}