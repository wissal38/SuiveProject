<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'reference';
    
    protected $fillable = [
        'reference',
        'index_precedant',
        'index_suivant',
        'date_payment',
        'date_limite_p',
        'type_facture',
        'montant',
        'compteur_id',
    ];

    // Define relationship with the Compteur model
    public function compteur()
    {
        return $this->belongsTo(Compteur::class);
    }

    // Méthode pour récupérer les factures groupées par mois et par type de facture
    public static function getGroupedFactures($region, $local)
    {
        return Facture::where('region', $region)
            ->where('local', $local)
            ->groupBy(function ($facture) {
                return \Carbon\Carbon::parse($facture->date_limite_p)->format('Y-m') . '_' . $facture->type_facture;
            })
            ->get();
    }
}
