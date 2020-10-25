<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservacionController extends Controller
{
	public function index(Request $request) {

		$destinos = app(DestinoController::class)->getData($request);

		return view('inicio.inicio',compact('destinos'));
	}
}
