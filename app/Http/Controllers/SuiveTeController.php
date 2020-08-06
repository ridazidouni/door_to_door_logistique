<?php

namespace App\Http\Controllers;

use App\SuiveTe;
use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;
use Auth;
use App\Exports\SuiveTeExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use DB;
use App\Charts\SuiveTeChart;

class SuiveTeController extends Controller
{   
    
    public function __construct()
    {
 
    }

    public function statistics()
    {
        if(!Auth::user()->is_admin)
        {
            return redirect()->route('admin');
        }
        

        $data = DB::table('suive_tes')
        ->join('users as u', 'suive_tes.Tractionnaire', '=', 'u.id')
        ->select('name',DB::raw('count(Tractionnaire) as total'))
        ->groupBy('name')
        ->get();

        $data = (array)$data;
        $labels = array();
        $dataset = array();
        

        foreach($data as $items)
        {
            foreach($items as $item)
            {
                foreach($item as $key => $value)
                {
                    if($key == 'name')
                    {
                        $labels[] = $value;
                    }
                    if($key == 'total')
                    {
                        $dataset[] = $value;
                    }
                }
            }
        }

        $chart = new SuiveTeChart;
        $chart->labels($labels);
        $chart->dataset('My dataset', 'pie', $dataset)->options([
            'backgroundColor' => ['#ff0000','#bf00ff','#00ffbf','#ffbf00','#aaff00','#FF9671','#D65DB1','#008564','#308332','#A46D25','#C25E7C','#F9F871'],
        ]);
        

        $dayscount = array();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today())->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(1))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(2))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(3))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(4))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(5))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(6))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(7))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(8))->count();
        $dayscount[] = SuiveTe::whereDate('RTS_time', today()->subDays(9))->count();


        $daysname = array();
        $daysname[] = today()->format('Y-m-d');
        $daysname[] = today()->subDays(1)->format('Y-m-d');
        $daysname[] = today()->subDays(2)->format('Y-m-d');
        $daysname[] = today()->subDays(3)->format('Y-m-d');
        $daysname[] = today()->subDays(4)->format('Y-m-d');
        $daysname[] = today()->subDays(5)->format('Y-m-d');
        $daysname[] = today()->subDays(6)->format('Y-m-d');
        $daysname[] = today()->subDays(7)->format('Y-m-d');
        $daysname[] = today()->subDays(8)->format('Y-m-d');
        $daysname[] = today()->subDays(9)->format('Y-m-d');


        $today = today()->subDays(9)->format('Y-m-d');
        $chartdays = new SuiveTeChart;
        
        $chartdays->labels($daysname);
        $chartdays->dataset('les opérations', 'line', $dayscount)->options([
            'backgroundColor' => ['#ff0000','#bf00ff','#00ffbf','#ffbf00','#aaff00','#FF9671','#D65DB1','#008564','#308332','#A46D25','#C25E7C','#F9F871'],
        ]);
        
        return view('statistics', compact('chart','chartdays','today'));
    }

    public function Allrow(Request $request)
    {

        if(request()->ajax())
        {
            if(Auth::user()->is_admin || Auth::user()->onlyread || Auth::user()->TE_chipment)
            {
                $data = DB::table('suive_tes')
                ->join('users', 'suive_tes.user_id', '=', 'users.id')
                ->join('users as u', 'suive_tes.Tractionnaire', '=', 'u.id')
                ->select('suive_tes.*','users.name as ajouter_par','u.name as Tractionnaire_')
                ->latest('RTS_time')->take(1000);
                

                return Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    if(Auth::user()->is_admin && $data->user_id == Auth::user()->id)
                        return '<a href="edit\\' . $data->id . '" class="btn-sml btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a type="button" class="btn-sml open-Dialog btn btn-success" data-id=" ' . $data->id . '"><i class="fa fa-trash"></i></a>';
                    if(Auth::user()->TE_chipment)
                        return '<a href="edit\\' . $data->id . '" class="btn-sml btn btn-warning"><i class="fa fa-edit"></i></a>';
                })
                ->make(true);
            }
            else
            {
                $data = DB::table('suive_tes')
                ->Where('suive_tes.Tractionnaire','=', Auth::user()->id)
                ->select('suive_tes.*')
                ->latest('RTS_time')->take(1000);

                return Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    return '<a href="edit\\' . $data->id . '" class="btn-sml btn btn-warning"><i class="fa fa-edit"></i></a>';
                })->make(true);
            }

        }
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }



    public function ajouter()
    {
        if((Auth::user()->TE_chipment == 0 && Auth::user()->onlyread == 0 && Auth::user()->is_admin == 0) || Auth::user()->onlyread)
        {
            return redirect()->route('admin');
        }


        $users = DB::table('users')
        ->where('is_admin','!=', 1)
        ->where('TE_chipment','!=', 1)
        ->where('onlyread','!=', 1)
        ->select('users.*')->get();

        $users = (array)$users;
        $style = 'style=color:red';

        return view('ajouter',compact('users','style'));
    }
    

    public function search($date1,$date2)
    {

        if(request()->ajax())
        {
            $date1 = Carbon::parse($date1)->format('Y-m-d');
            $date2 = Carbon::parse($date2)->format('Y-m-d');

            session(['data1' => $date1]);
            session(['data2' => $date2]);

            if(Auth::user()->is_admin || Auth::user()->onlyread || Auth::user()->TE_chipment)
            {
                $data = DB::table('suive_tes')
                ->join('users', 'suive_tes.user_id', '=', 'users.id')
                ->join('users as u', 'suive_tes.Tractionnaire', '=', 'u.id')
                ->whereBetween('RTS_time',[$date1,$date2])
                ->select('suive_tes.*','users.name as ajouter_par','u.name as Tractionnaire_');
                
                return Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    if(Auth::user()->is_admin && $data->user_id == Auth::user()->id)
                        return '<a href="edit\\' . $data->id . '" class="btn-sml btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a type="button" class="btn-sml open-Dialog btn btn-success" data-id=" ' . $data->id . ' "><i class="fa fa-trash"></i></a>';
                    if(Auth::user()->TE_chipment)
                        return '<a href="edit\\' . $data->id . '" class="btn-sml btn btn-warning"><i class="fa fa-edit"></i></a>';
                })
                ->make(true);
            }
            else
            {
                $data = DB::table('suive_tes')
                ->whereBetween('RTS_time',[$date1,$date2])
                ->Where('suive_tes.Tractionnaire','=', Auth::user()->id)
                ->select('suive_tes.*');

                return Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    return '<a href="edit\\' . $data->id . '" class="btn-sml btn btn-warning"><i class="fa fa-edit"></i></a>';
                })->make(true);
            }
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if((Auth::user()->TE_chipment == 0 && Auth::user()->onlyread == 0 && Auth::user()->is_admin == 0) || Auth::user()->onlyread)
        {
            return redirect()->route('admin');
        }

        $validatedData = $request->validate([
            'RTS_time' => 'required'
        ]);


        $tarking = $request->toArray();

        foreach ($tarking as $key => $item) {
            $dt = DateTime::createFromFormat("m/d/Y g:i A", $item);
            if($dt)
            {
                $request[$key] = Carbon::parse($item)->format('Y-m-d H:i');
            }
        }

        $tark = new SuiveTe();

        if(Auth::user()->is_admin)
            $tark->Tractionnaire = $request->Tractionnaire;
        else
            $tark->Tractionnaire = Auth::user()->id;

        $tark->RTS_time =  $request->RTS_time;
        $tark->Plate_Number = $request->Plate_Number;
        $tark->Van’s_type = $request->Van’s_type;
        $tark->Plate_Number = $request->Plate_Number;
        $tark->Origin = $request->Origin;
        $tark->Destination = $request->Destination;
        $tark->RTS_request_Time = $request->RTS_request_Time;
        $tark->RTS_closing_Time = $request->RTS_closing_Time;
        $tark->Positionning_time = $request->Positionning_time;
        $tark->Van_arrival_Time = $request->Van_arrival_Time;
        $tark->Invoice_sharing_time = $request->Invoice_sharing_time;
        $tark->Warehouse_exit = $request->Warehouse_exit;
        $tark->CustomsClearance = $request->CustomsClearance;
        $tark->Port_exit = $request->Port_exit;
        $tark->Arrival_Time = $request->Arrival_Time;
        $tark->Unloading_time = $request->Unloading_time;
        $tark->Immobilisation_Loading = $request->Immobilisation_Loading;
        $tark->Immobilisation_Unloading = $request->Immobilisation_Unloading;
        $tark->Comments_trspt_team = $request->Comments_trspt_team;
        $tark->List_of_shipment_nbrs = $request->List_of_shipment_nbrs;
        $tark->Nbr_of_DNs = $request->Nbr_of_DNs;
        $tark->AEP_validation_Time = $request->AEP_validation_Time;
        $tark->WH_comments = $request->WH_comments;
        $tark->Transportation_comments = $request->Transportation_comments;
        $tark->Poids_Taxable = $request->Poids_Taxable;
        $tark->Weight = $request->Weight;
        $tark->Volume = $request->Volume;

        $tark->user_id = Auth::user()->id;

        $tark->save();

        return redirect()->route('admin')->with('status','Opération terminée avec succès');

    }








    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuiveTe  $suiveTe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = SuiveTe::find($id);

        $this->authorize('update',$request);
        
        $disabled = 'disabled';
        $style = 'style=color:red';
        if(Auth::user()->is_admin || Auth::user()->TE_chipment)
        {
            $disabled = '';
            //$style = '';
        }

        $tarking = $request->toArray();


        foreach ($tarking as $key => $item) {
            $dt = DateTime::createFromFormat("Y-m-d H:i:s", $item);
            if($dt)
            {
                $request[$key] = Carbon::parse($item)->format('m/d/Y g:i A');
            }
        }

        $users = DB::table('users')
        ->where('is_admin','!=', 1)
        ->where('TE_chipment','!=', 1)
        ->where('onlyread','!=', 1)
        ->select('users.*')->get();

        $users = (array)$users;

        return view('edit',compact('request','users','disabled','style'));
    }





    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuiveTe  $suiveTe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $tark = SuiveTe::find($id);
        

        $this->authorize('update',$tark);
        
        $tarking = $request->toArray();

        foreach ($tarking as $key => $item) {
            $dt = DateTime::createFromFormat("m/d/Y g:i A", $item);
            if($dt)
            {
                $request[$key] = Carbon::parse($item)->format('Y-m-d H:i:s');
            }
        }

        $data = request()->all();

        unset($data['_token']);
        unset($data['_method']);

        SuiveTe::where('id', $id)->update($data);

        return redirect()->route('admin')->with('status','Opération terminée avec succès');
    }



    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuiveTe  $suiveTe
     * @return \Illuminate\Http\Response
     */

    public function destroy(request $id)
    {
        $tark = SuiveTe::find($id->idinput);
        
        $this->authorize('delete',$tark);

        $tark->delete();

        return redirect()->route('admin')->with('status','Opération terminée avec succès');
    }

    public function export() 
    {
        return Excel::download(new SuiveTeExport(session('data1'),session('data2')), 'SuiviTe.xlsx');
    }

}
