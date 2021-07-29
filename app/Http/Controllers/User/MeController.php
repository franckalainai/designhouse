<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function getMe()
    {
        // si la l'utilisateur est connéectée
        if (auth()->check()) {
            return response()->json(["user" => auth()->user()], 200);
        }
        // s'il n'ya pas d'utilisateur connecté
        return response()->json(null, 401);
    }
}
