<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use ConsoleTVs\Charts\Facades\Charts;

class ChartController extends Controller
{
    public function index()
    {
        // Récupérer les données pour le graphique depuis la base de données
        $factures = Facture::all();

        // Regrouper les montants des factures par type de facture et par date limite de paiement
        $data = [];
        foreach ($factures as $facture) {
            if (!isset($data[$facture->type_facture])) {
                $data[$facture->type_facture] = [];
            }
            $data[$facture->type_facture][$facture->date_limite_p] = $facture->montant;
        }

        // Créer une instance de graphique (type: line)
        $chart = Charts::multi('line', 'highcharts');

        // Ajouter les données à votre graphique
        foreach ($data as $type => $montants) {
            $chart->labels(array_keys($montants));
            $chart->dataset($type, array_values($montants));
        }

        // Afficher la vue avec le graphique
        return view('chart', compact('chart'));
    }
}
