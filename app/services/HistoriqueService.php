<?php


namespace App\services;


use App\interfaces\IHistorique;
use App\Models\Historique;

class HistoriqueService implements IHistorique
{

    public function store($logment, $actions)
    {
        // TODO: Implement store() method.
        $bean = new Historique();
        $bean->user_id = auth()->id();
        $bean->logement_id = $logment;
        $bean->action = $actions;
        $bean->save();

    }
}
