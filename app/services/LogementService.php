<?php


namespace App\services;


use App\Http\Resources\LogementResource;
use App\interfaces\IHistorique;
use App\interfaces\ILogement;
use App\Models\Logement;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LogementService implements ILogement
{
    private $service;

    public function __construct(IHistorique $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // TODO: Implement index() method.
        $all = Logement::all();
        return response()->json(LogementResource::collection($all), 200);
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.


        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'quartier' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // on save le logement
        $logement = Logement::create([
            "type" => $request->type,
            "description" => $request->description,
            "prix" => $request->prix,
            "ville" => $request->ville,
            'pays' => $request->pays,
            "quartier" => $request->quartier,
            'statut' => "En Attente",
            'proprietaire' => auth()->id()
        ]);

        $this->service->store($logement->id, "INSERTION");
        return response()->json([
            "statut" => "Succes",
            "data" => $logement
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
        $bean = Logement::where('id', $id)->first();
        if (!$bean) return response()->json(["statut" => "Echec", "data" => "Cette ressource n'existe pas !"], Response::HTTP_BAD_REQUEST);

        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'quartier' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $bean->type = $request->type;
        $bean->description = $request->description;
        $bean->prix = $request->prix;
        $bean->ville = $request->ville;
        $bean->pays = $request->pays;
        $bean->updated_at = now();
        $bean->save();

        $this->service->store($bean->id, "MODIFICATION");

        return response()->json([
            "statut" => "Succes",
            "data" => $bean
        ], 200);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        $bean = Logement::where('id', $id)->first();
        if (!$bean) return response()->json(['message' => "cette ressource n'existe pas"],
            Response::HTTP_NOT_FOUND);
        return response()->json(['statut' => "Success", "data" => $bean], 200);
    }

    public function desable($id)
    {
        // TODO: Implement desable() method.
        return $this->desableOrEnable("INACTIF", $id);

    }

    public function enable($id)
    {
        // TODO: Implement enable() method.
        return $this->desableOrEnable('ACTIF', $id);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
        $bean = Logement::where('id', $id)->first();
        if (!$bean) return response()->json(['message' => "cette ressource n'existe pas"],
            Response::HTTP_NOT_FOUND);
        $this->service->store($bean->id, "Supprimer");
        $bean->delete();
        return \response()->json(['statut' => "Success", 'data' => "Suppression effectuée"], 200);

    }


    public function listByProprio()
    {
        // TODO: Implement listByProprio() method.
        $all = Logement::where('proprietaire', auth()->id())->get();
        return response()->json([
            "statut" => "Succes",
            "data" => $all
        ], 200);
    }

    public function desableOrEnable($statut, $id)
    {
        $bean = Logement::where('id', $id)->first();
        if (!$bean) return response()->json(['message' => "cette ressource n'existe pas"],
            Response::HTTP_NOT_FOUND);

        $bean->statut = $statut;
        $bean->updated_at = now();
        $bean->save();

        // j'enregistre l'historique
        $this->service->store($bean->id, $statut === "INACTIF" ? "DESACTIVATION" : "ACTIVATION");

        return response()->json([
            "statut" => "Succes",
            "data" => $bean
        ], 200);
    }

    public function addMedia($idLogement, Request $request)
    {
        // TODO: Implement addMedia() method.
        if ($request->hasFile('path')) {
            $path = $request->file('path');
            $name = 'images' . random_int(1, 100000) . '.' . $path->getClientOriginalExtension(); // generer un  nom de fichier
            $path->storeAs("public/logements/" . auth()->user()->nom, $name);

            $media = new Media();
            $media->path = $name;
            $media->logement_id = $idLogement;
            $media->save();
            return \response()->json(['message' => 'Media ajouté'], 201);
        } else {
            return \response()->json(['erreur' => "Veuillez choisir une image"], Response::HTTP_NOT_ACCEPTABLE);
        }

    }
}
