<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\Region;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreLocalRequest;
use App\Http\Requests\UpdateLocalRequest;

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-local|edit-local|delete-local', ['only' => ['index','show']]);
        $this->middleware('permission:create-local', ['only' => ['create','store']]);
        $this->middleware('permission:edit-local', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-local', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $locals = Local::latest('id')->paginate(3);
        return view('locals.index', compact('locals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        $regions = Region::all(); // Récupérer toutes les régions
        return view('locals.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocalRequest $request): RedirectResponse
    {
        Local::create($request->all());
        return redirect()->route('locals.index')->withSuccess('New Local is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local): View
    {
        return view('locals.show', compact('local'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local): View
    {
        $regions = Region::all(); // Récupérer toutes les régions
        return view('locals.edit', compact('local', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocalRequest $request, Local $local): RedirectResponse
    {
        $local->update($request->all());
        return redirect()->back()->withSuccess('Local is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local): RedirectResponse
    {
        $local->delete();
        return redirect()->route('locals.index')->withSuccess('Local is deleted successfully.');
    }
}
