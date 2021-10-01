<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\Request;
use App\Authorizable;
use DB;
use Illuminate\Support\Facades\Auth;



class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Cars::all();

        return view('custompage', compact("cars"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        

        $this->validate($request, [
            'car_year' => 'bail|required|min:2',
            'car_model' => 'required|min:2',
            
              

        ]);

        // hash password
       


       
            
        $file = $request->file('img_url');
        if ($file) {
            $inputPath =  public_path().'/images';
            if($file->move($inputPath,$file->getClientOriginalName())) {
                $fileName = $file->getClientOriginalName();
                $filePath = url('/').'/images/'.$file->getClientOriginalName();
            } else {
                $filePath = '';
            }  
        } else {
            $filePath = '';
        }


        // Create the user
        
        $carData = [
            'car_year' => $request->get('car_year'),
            'car_model' => $request->get('car_model'),
            'car_color' => $request->get('car_color'), 
            'car_mileage' => $request->get('car_mileage'),
            'img_url' => $filePath, 
            'user_id' => Auth::id()
            
        ];
            

           // DB::table('cars')->insert($carData);
            Cars::insert($carData);
            session()->flash('message', 'Car Details Added successfully.');
            return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // return view('welcome');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carData = Cars::where('id', '=', $id)->where('user_id', '=', Auth::id())->firstOrFail();
        return view('car_edit',compact('carData'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'car_year' => 'bail|required|min:2',
            'car_model' => 'required|min:2',
        ]);

            
        $file = $request->file('img_url');
        if ($file) {
            $inputPath =  public_path().'/images';
            if($file->move($inputPath,$file->getClientOriginalName())) {
                $fileName = $file->getClientOriginalName();
                $filePath = url('/').'/images/'.$file->getClientOriginalName();
            } else {
                $filePath = '';
            }  
        } else {
            $filePath = '';
        }


        // Create the user
        
            $carData = [
                'car_year' => $request->get('car_year'),
                'car_model' => $request->get('car_model'),
                'car_color' => $request->get('car_color'), 
                'car_mileage' => $request->get('car_mileage'),
                'img_url' => $filePath, 
                
            ];
            

            DB::table('cars')->where('id',$request->id)->update($carData);
           // Cars::insert($carData);
           session()->flash('message', 'Car Details successfully updated.');
           return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Cars::find($id)->delete();
        return redirect()->back();
    }


    public function customcarlist() {

        $cars = Cars::all();
        return view('welcome', compact("cars"));

    }


   


}
