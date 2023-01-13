<?php

namespace App\interfaces;

use Illuminate\Http\Request;

interface IRole
{
    public function store(Request $request);

    public function update(Request $request);

    public function delete();
    
    public function show();
    
}