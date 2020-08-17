<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UtilitiesController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */

    public function getRoleName($role_id)
    {
        $roleName = DB::table('roles')->orderBy('name', 'asc')->where('id', $role_id)->first();
        //var_dump($roleName);
        return $roleName->name;
    }

    public function getUserRole($user_id)
    {
        $role = DB::table('role_user')->where('user_id', $user_id)->first();
        //var_dump($role);
        return $this->getRoleName((string) $role->role_id);
    }

    public function getUserMicrositios($user_id)
    {
        $micrositios = DB::table('micrositios')
            ->join('clientehasmicrositios', function ($join) use (&$user_id) {
                $join->on('micrositios.id', '=', 'clientehasmicrositios.id_micrositio')->where('clientehasmicrositios.id_user', '=', $user_id);
            })
            ->get();

        return $micrositios;
    }

    public function getByUrl(Request $request, $url)
    {
        //var_dump($url);
        $id_micrositio = DB::table('micrositios')->where('url', "=", (string) $url)->select('micrositios.id')->first();
        //var_dump((string) $id_micrositio->id);
        return (string) $id_micrositio->id;
    }
}
