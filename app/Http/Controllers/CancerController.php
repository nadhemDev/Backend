<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cancer;
use App\Patient;

class CancerController extends Controller
{
    public function index ()
    {
        $cancer = Cancer::all();
        return response()->json([
            $cancer
        ],200);
    }


    public function cancer(Request $request){
        //$category = Categories::with('product')->find($request->get('category_id'));
        $patient = patient::find($id);
        $cancer = Cancer::find($patient->cancer_id);

        return response()->json(
            $cancer
        );
    }


}
