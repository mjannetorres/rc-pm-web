<?php

namespace App\Http\Controllers;

Use \Carbon\Carbon;
Use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WorkLogController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        
        try {
            $logs = DB::table('pm_worklogs')->insert([
                'workerid' => $request->workerid,
                'worker' => $request->worker,
                'roleid' => $request->roleid,
                'role' => $request->role,
                'output' => $request->output,
                'qty' => $request->qty,
                'jono' => $request->jono,
                'clientid' => $request->clientid,
                'client' => $request->client,
                'createdbyid'=> $request->createdbyid,
                'createddatetime' => $date->format('Y-m-d H:i:s'),
                'cancelled' => false
            ]);

            return $logs;
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
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
        try {
            $logs = DB::table('pm_worklogs')
                        ->leftJoin('jo_detail', 'jo_detail.id', '=', 'pm_worklogs.output')                               
                        ->select('pm_worklogs.id', 'pm_worklogs.worker', 'pm_worklogs.createddatetime as date', 'pm_worklogs.qty', 'pm_worklogs.role', 'jo_detail.description as desc')
                        ->selectRaw('pm_worklogs.output, pm_worklogs.roleid, pm_worklogs.workerid')
                        ->where('pm_worklogs.jono', '=', $id)   
                        ->where('pm_worklogs.cancelled', '=', false)                      
                        ->orderBy('pm_worklogs.createddatetime')                
                        ->get();

            return response($logs, 200);

        } catch (Exception $e)
        {             
            return response($e->getMessage(), 400);
            
        }          
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
        $date = Carbon::now();
        
        try {
            $logs = DB::table('pm_worklogs')
                    ->where('id', $id)
                    ->update([
                    'workerid' => $request->workerid,
                    'worker' => $request->worker,
                    'roleid' => $request->roleid,
                    'role' => $request->role,
                    'output' => $request->output,
                    'qty' => $request->qty,                           
                    'updatedbyid'=> $request->updatedbyid,
                    'updateddatetime' => $date->format('Y-m-d H:i:s')                    
                ]);

            return $logs;
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }        
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $date = Carbon::now();
        try {
            $logs = DB::table('pm_worklogs')
                    ->where('id', $id)
                    ->update([                                               
                    'cancelledbyid'=> $request->cancelledbyid,
                    'cancelleddatetime' => $date->format('Y-m-d H:i:s'),
                    'cancelled' => true
                ]);

            return $logs;
        } catch (Exception $e) {
            return response($e->getMessage(), 400);
        }        
    }
}
