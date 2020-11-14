<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserVehicle;
use App\Models\UserVehicleVisit;
use Illuminate\Http\Request;

class UserVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::nameOrDNI(request()->get('user'))->pluck('id')->toArray();

        $user_vehicles = UserVehicle::with('user')
                        ->license(request()->get('license'))
                        ->users($users)
                        ->get();

        return response()->json([
            'success'  => true,
            'data'     => $user_vehicles 
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::updateOrCreate(
                ['dni' => $request->dni],
                [
                    'name'  => $request->name,
                    'dni'   => $request->dni,
                ]
            );
    
            $user_vehicle = UserVehicle::updateOrCreate(
                ['license'  => $request->license],
                [
                    'user_id'               => $user->id,
                    'vehicle_brand_id'      => $request->vehicle_brand_id,
                    'license'               => $request->license,
                    'type'                  => $request->type
            
                ]);
            
            
            if($user && $user_vehicle) {
                $user_vehicle_visit = UserVehicleVisit::create([
                    'user_id'           => $user->id,
                    'user_vehicle_id'   => $user_vehicle->id
                ]);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Información guardada correctamente'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 422);
        }        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
