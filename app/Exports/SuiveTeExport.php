<?php

namespace App\Exports;

use App\SuiveTe;
use Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class SuiveTeExport implements FromCollection ,WithHeadings
{


    protected $date1;
    protected $date2;

    function __construct($date1,$date2) {
            $this->date1 = $date1;
            $this->date2 = $date2;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(Auth::user()->is_admin = true || Auth::user()->onlyread = true || Auth::user()->TE_chipment = true)
            {
                $data = DB::table('suive_tes')
                ->join('users', 'suive_tes.user_id', '=', 'users.id')
                ->join('users as u', 'suive_tes.Tractionnaire', '=', 'u.id')
                ->whereBetween('RTS_time',[$this->date1,$this->date2])
                ->select('RTS_time','u.name','Plate_Number',
                'Van’s_type','Origin','Destination' , 'RTS_request_Time', 
                'RTS_closing_Time','Positionning_time','Van_arrival_Time', 
                'Invoice_sharing_time', 'Warehouse_exit','CustomsClearance','Port_exit',
                'Arrival_Time','Unloading_time','Immobilisation_Loading','Immobilisation_Unloading',
                 'Comments_trspt_team','List_of_shipment_nbrs','Nbr_of_DNs',
                 'AEP_validation_Time','WH_comments', 'Transportation_comments',
                 'Poids_Taxable','Weight', 'Volume')
                ->get();
                
            }
            else
            {
                $data = DB::table('suive_tes')
                ->whereBetween('RTS_time',[$this->date1,$this->date2])
                ->Where('suive_tes.Tractionnaire','=', Auth::user()->id)
                ->select('RTS_time','Plate_Number',
                'Van’s_type','Origin','Destination' , 'RTS_request_Time', 
                'RTS_closing_Time','Positionning_time','Van_arrival_Time', 
                'Invoice_sharing_time', 'Warehouse_exit','CustomsClearance','Port_exit',
                'Arrival_Time','Unloading_time','Immobilisation_Loading','Immobilisation_Unloading',
                 'Comments_trspt_team','List_of_shipment_nbrs','Nbr_of_DNs',
                 'AEP_validation_Time','WH_comments', 'Transportation_comments',
                 'Poids_Taxable','Weight', 'Volume')
                ->get();
            }

        return $data;
    }

    public function headings() : array
    {
        return ['RTS_time','Tractionnaire','Plate_Number',
        'Van’s_type','Origin','Destination' , 'RTS_request_Time', 
        'RTS_closing_Time','Positionning_time','Van_arrival_Time', 
        'Invoice_sharing_time', 'Warehouse_exit','CustomsClearance','Port_exit',
        'Arrival_Time','Unloading_time','Immobilisation_Loading','Immobilisation_Unloading',
         'Comments_trspt_team','List_of_shipment_nbrs','Nbr_of_DNs',
         'AEP_validation_Time','WH_comments', 'Transportation_comments',
         'Poids_Taxable','Weight', 'Volume'];
    }
}
