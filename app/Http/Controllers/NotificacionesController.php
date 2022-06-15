<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $notificaciones = auth()->user()->unreadNotifications;//para mostrar notificaciones que no se han visto

        auth()->user()->unreadNotifications->markAsRead();/* Una vez vista las notificaciones no mostrarlos en la pagina principal */

        return view('Notificaciones.index', compact('notificaciones'));
    }
}
