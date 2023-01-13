<?php


namespace App\interfaces;


use Illuminate\Http\Request;

interface IUser
{
    public function register(Request $request); // creer un compte

    public function login(Request $request); // permet de se connecter

    public function logout(); // permet de se deconnecter

    public function refresh(); // permet de rafraichir le token

}
