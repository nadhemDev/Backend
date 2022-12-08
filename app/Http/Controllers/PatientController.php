<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Cancer;

use Illuminate\Http\Request;

class PatientController extends Controller
{


    //index function
    public function index()
    {
        $patient = Patient::all();
        return response()->json([
            'patient' => $patient,
        ], 200);
    }



    public function create(Request $request)
    {
        //create patient
        $request->validate([
            'name' => 'required|string',
            'prenom' => 'required|string',
            'date_nai' => 'required|string',
            'age_diagnostique' => 'required|integer',
            'cancer_id' =>'required|integer',
        ]);
        $patient = new Patient([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'date_nai' => $request->date_nai,
            'age_diagnostique' => $request->age_diagnostique,
            'cancer_id' =>$request->cancer_id,
        ]);


        $patient->save();
        return response()->json(
            $patient,
            201
        );
    }

    //update patient
    public function edit(Request $request, $id)
    {

        $patient = Patient::find($id);
        $patient->name = $request->name;
        $patient->prenom = $request->prenom;
        $patient->date_nai = $request->date_nai;
        $patient->age_diagnostique = $request->age_diagnostique;





        $patient->save();
        return response()->json(
            $patient,
            201
        );
    }

    //Search patient
    public function Search(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name =  $request->get('name');

        $Search_patient = Patient::where('name', 'Like', "%" . $name . "%")->get();
        return response()->json(

            $Search_patient,
            201
        );
    }

    //delete patient
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $msg = "Successfully deleted patient!";
            $patient->delete();
        } else {
            $msg = "patient not found!";
        }
        return response()->json([
            'message' => $msg
        ], 201);
    }


    public function one($id)
    {

        $patient = Patient::find($id);
        return response()->json(
            $patient
        );
    }


    public function cancer($id){
        $cancer = Cancer::find($id);
        $patient = Patient::Where('cancer_id', $cancer->id)->with('Cancer')->get();
        return response()->json(
            $patient
        );
    }
}
