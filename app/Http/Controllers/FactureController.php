<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Compteur;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreFactureRequest;
use App\Http\Requests\UpdateFactureRequest;

class FactureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-facture|edit-facture|delete-facture', ['only' => ['index','show']]);
        $this->middleware('permission:create-facture', ['only' => ['create','store']]);
        $this->middleware('permission:edit-facture', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-facture', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $factures = Facture::latest()->paginate(10);
        return view('factures.index', compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $compteurs = Compteur::all(); // Get all counters
        return view('factures.create', compact('compteurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFactureRequest $request): RedirectResponse
    {
        Facture::create($request->all());
        return redirect()->route('factures.index')->withSuccess('New Facture is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facture $facture): View
    {
        $formattedMontant = number_format($facture->montant, 3, ',', '.'); // Formatage du montant avec 3 décimales, une virgule comme séparateur décimal et un point comme séparateur de milliers
        return view('factures.show', compact('facture', 'formattedMontant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facture $facture): View
    {
        $compteurs = Compteur::all(); // Get all counters
        return view('factures.edit', compact('facture', 'compteurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFactureRequest $request, Facture $facture): RedirectResponse
    {
        $facture->update($request->all());
        return redirect()->back()->withSuccess('Facture is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facture $facture): RedirectResponse
    {
        $facture->delete();
        return redirect()->route('factures.index')->withSuccess('Facture is deleted successfully.');
    }
}
