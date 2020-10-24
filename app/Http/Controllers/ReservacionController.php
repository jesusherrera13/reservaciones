<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservacionController extends Controller
{
	public function index(Request $request) {

		// dd($request);
		return view('inicio.inicio');
	}
}
