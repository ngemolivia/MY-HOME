<?php


namespace App\interfaces;


use Illuminate\Http\Request;

interface ILogement
{

    public function index();

    public function store(Request $request);

    public function update(Request $request, $id);

    public function show($id);

    public function desable($id);

    public function enable($id);

    public function destroy($id);

    public function listByProprio();

    public function addMedia($idLogement, Request $request);
}
