<?php

namespace App\Http\Controllers;

Use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JobOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Hello World';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->id;
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
            $order_details = DB::table('jo_detail')
                        ->join('jo_header', 'jo_header.id', '=', 'jo_detail.headerid')    
                        ->join('jo_clients', 'jo_header.clientid', '=', 'jo_clients.id')         
                        ->select('jo_header.jono', 'jo_header.clientid', 'jo_clients.name as client', 'jo_detail.description', 'jo_detail.fabric', 'jo_detail.qty', 'jo_detail.free', 'jo_detail.cost', 'jo_detail.totalcost as total')
                        ->where('jo_header.id', '=', $id)                       
                        ->orderBy('jo_detail.id')                
                        ->get();

            return response($order_details, 200);

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {            
            try
            {                
                $count = DB::table('jo_header')
                        ->join('jo_clients', 'jo_header.clientid', '=', 'jo_clients.id')            
                        ->select('jo_header.id', 'jo_header.duedate', 'jo_clients.name as client')
                        ->where('jo_clients.name', 'like', '%'.$request->name.'%')        
                        ->whereBetween('jo_header.duedate', [$request->from, $request->to])                               
                        ->count();

                $joborder = DB::table('jo_header')
                            ->join('jo_clients', 'jo_header.clientid', '=', 'jo_clients.id')            
                            ->select('jo_header.id', 'jo_header.jono', 'jo_header.duedate', 'jo_header.status', 'jo_header.createddatetime as created', 'jo_header.balamnt as balance', 'jo_header.paidamnt as paid', 'jo_header.netamnt as amount', 'jo_clients.name as client')
                            ->where('jo_clients.name', 'like', '%'.$request->name.'%')        
                            ->whereBetween('jo_header.duedate', [$request->from, $request->to])
                            ->orderBy('jo_header.id', 'desc')
                            ->skip($request->offset)->take($request->limit)
                            ->get();

                $status = DB::table('jo_header')
                        ->join('jo_clients', 'jo_header.clientid', '=', 'jo_clients.id')            
                        ->selectRaw('count(if(jo_header.status is NULL, 1, 0)) as statuscount, jo_header.status')
                        ->where('jo_clients.name', 'like', '%'.$request->name.'%')                 
                        ->whereBetween('jo_header.duedate', [$request->from, $request->to])          
                        ->groupBy('jo_header.status')                     
                        ->get();
                        
                $response = [
                    'joborders' => $joborder,
                    'length' => $count,
                    'status' => $status
                ];

                return  response($response, 200);
            }
            catch(Exception $e)
            {             
                return response($e->getMessage(), 400);
                
            }       
    }

}
