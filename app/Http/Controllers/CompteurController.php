<?php

namespace App\Http\Controllers;

use App\Models\Compteur;
use App\Models\Local;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCompteurRequest;
use App\Http\Requests\UpdateCompteurRequest;

class CompteurController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-compteur|edit-compteur|delete-compteur', ['only' => ['index','show']]);
        $this->middleware('permission:create-compteur', ['only' => ['create','store']]);
        $this->middleware('permission:edit-compteur', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-compteur', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $compteurs = Compteur::latest()->paginate(3);
        return view('compteurs.index', compact('compteurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $locals = Local::all();
        return view('compteurs.create', compact('locals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompteurRequest $request): RedirectResponse
    {
        Compteur::create($request->validated());
        return redirect()->route('compteurs.index')->withSuccess('New Compteur is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compteur $compteur): View
    {
        return view('compteurs.show', compact('compteur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compteur $compteur): View
    {
        $locals = Local::all();
        return view('compteurs.edit', compact('compteur', 'locals')); // Updated to include $locals
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompteurRequest $request, Compteur $compteur): RedirectResponse
    {
        $compteur->update($request->validated());
        return redirect()->route('compteurs.index')->withSuccess('Compteur is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compteur $compteur): RedirectResponse
    {
        $compteur->delete();
        return redirect()->route('compteurs.index')->withSuccess('Compteur is deleted successfully.');
    }
}
