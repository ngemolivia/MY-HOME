<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'prix',
        'ville',
        'pays',
        'quartier',
        'statut',
        'proprietaire'
    ];

    public function medias()
    {
        return $this->hasMany(Media::class, "logement_id");
    }

    public function proprio()
    {
        return $this->belongsTo(User::class, "proprietaire");
    }
}
