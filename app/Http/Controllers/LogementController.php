<?php

namespace App\Http\Controllers;

use App\interfaces\ILogement;
use App\interfaces\IUser;
use App\Models\Logement;
use Illuminate\Http\Request;

class LogementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $service;

    public function __construct(ILogement $service)
    {
        $this->service = $service;
//        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    public function index()
    {
        //
        return $this->service->index();
    }


    public function desable($id)
    {
        return $this->service->desable($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Logement $logement
     * @return \Illuminate\Http\Response
     */
    public function show($logement)
    {
        return $this->service->show($logement);
    }


    public function enable($logement)
    {

        return $this->service->enable($logement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Logement $logement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $logement)
    {
        return $this->service->update($request, $logement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Logement $logement
     * @return \Illuminate\Http\Response
     */
    public function destroy($logement)
    {
        return $this->service->destroy($logement);
    }

    public function listByProprio()
    {
        return $this->service->listByProprio();
    }

    public function addMedia($idLogement, Request $request)
    {
        return $this->service->addMedia($idLogement, $request);
    }
}
