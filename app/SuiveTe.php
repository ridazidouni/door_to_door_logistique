<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class SuiveTe extends Model
{
    public $timestamps = false;

    protected $table = 'suive_tes';

    protected $fillable = ['user_id','Tractionnaire','RTS_time','Plate_Number',
    'Van’s_type','Origin','Destination' , 'RTS_request_Time', 
    'RTS_closing_Time','Positionning_time','Van_arrival_Time', 
    'Invoice_sharing_time', 'Warehouse_exit','CustomsClearance','Port_exit',
    'Arrival_Time','Unloading_time','Immobilisation_Loading','Immobilisation_Unloading',
     'Comments_trspt_team','List_of_shipment_nbrs','Nbr_of_DNs',
     'AEP_validation_Time','WH_comments', 'Transportation_comments',
     'Poids_Taxable','Weight', 'Volume'];


    public function user()
    {
        return $this->belongsTo(User::Class);
    }
}
