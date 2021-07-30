<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class MeController extends Controller
{
    public function getMe()
    {
        // si la l'utilisateur est connéectée
        if (auth()->check()) {
            $user = auth()->user();
            return new UserResource($user);
            //return response()->json(["user" => $user], 200);
        }
        // s'il n'ya pas d'utilisateur connecté
        return response()->json(null, 401);
    }
}
