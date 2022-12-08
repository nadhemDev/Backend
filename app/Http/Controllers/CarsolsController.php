<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carosel;

class CarsolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carosel = Carosel::all();
        return response()->json(
            [
            'carosel' => $carosel,
            'path' => url('images/carosel')."/"
        	]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)

         {

        $update = false;
         if(isset($request->id))
        {

        	$update = true;
        }
        
        if(!$update)
        {
		$request->validate([
           'name_cat' => 'required|string',
            'image' => 'required'
        ]);
        }
        
        if(isset($request->image))
        {
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'images/carosel'; 
        $request->image->move($path,$file_name);
    	}
        if($update)
        {
        	$carosel = Carosel::find($request->id);
        	echo json_encode($_POST);
        	$carosel->name_cat = $request->name_cat;
        	if(isset($request->image))
        	{
        		$carosel->image = $file_name;
        	}
        }
        else
        {
        	$carosel = new Carosel([
                  'name_cat'=>$request->name_cat,
                  'image'=>$file_name
                 ]);
        }
            


          $carosel->save();
        return response()->json(
           $carosel
        , 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
        {
          $carosel = Carosel::find($id);
        return response()->json([
            'carosel' => $carosel,
            'path' => url('images/carosel')."/"
        ]
        , 201);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

    	
        $file_extension = $request->image->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = 'images/carosel'; 
        $request->image->move($path,$file_name);
    	
        	$carosel = Carosel::find($id);
        	$carosel->name_cat = $request->name_cat;
        	$carosel->image = $file_name;
        	
  
          	$carosel->save();
            return response()->json(
       	 $carosel
   		 , 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $carosel=Carosel::find($id);
        if($carosel) {
            $msg = "Successfully deleted Carosel!";
            $carosel->delete();
        }
        else{
            $msg = "Carsoel not found!";

        }
    return response()->json([
        'message' => $msg
    ], 201);
    }
}
