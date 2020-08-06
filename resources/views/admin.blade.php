@extends('layouts.app')

@section('content')
<style>
    input[type="search"]:focus,{   
        display: block;
        width: 100%;
        height: calc(1.6em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        -webkit-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    th { 
    font-size: 9px;
    font-weight:300;
    
}
td { 
    font-size: 10px;
    font-weight:600;
}
.btn-sml {
    padding: 2px 2px;
    font-size: 12px;
    border-radius: 0px;
}
.invisible
{
    display: none;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 2px 1px; /* e.g. change 8x to 4px here */
    text-align: center;
    
}
@media (max-width: 600px) {
  .mx-sm-3,.btn-secondary,.btn-danger,.btn-primary {
    width: 100%;
  }
}

</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

        @if(session()->has('status'))
            <hr>
            <div class="row justify-content-center pt-2">
                <div class="alert alert-success" role="alert">
                    {{ session()->get('status') }}
                </div>
            </div>
        @endif

        <hr>

        <div class="row myclass">
            <div class="col-md-10">
            <form class="form-inline" method="GET" action="{{ route('index.export') }}">
                @csrf
                        <label class="label">Filtrer Voyage(s) :</label>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="Date_Ref2" class="sr-only">{{ __('Date_Ref') }}</label>
                            <div class="input-group date" id="Date_Ref2" data-target-input="nearest">
                                <input type="text" id="Date1_Ref" name="Date_Ref2" class="form-control datetimepicker-input" placeholder="Filtrer depuis" data-target="#Date_Ref2"/>
                                <div class="input-group-append" data-target="#Date_Ref2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
    
                            <script type="application/javascript">
                                $(function () {
                                    $('#Date_Ref2').datetimepicker({
                                        Timepicker: false,
                                        format:'Y-MM-DD',
                                    });
                                });
                            </script>
                        </div>


                        <div class="form-group mx-sm-3 mb-2 date">
                            
                            <label for="Date_Ref" class="sr-only">{{ __('Date_Ref') }}</label>
                            
                            <div class="input-group date" id="Date_Ref" data-target-input="nearest">
                                <input type="text" id="Date2_Ref" name="Date_Ref" class="form-control datetimepicker-input"  placeholder="Vers" data-target="#Date_Ref"/>
                                <div class="input-group-append" data-target="#Date_Ref" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
    
                            <script type="application/javascript">
                                $(function () {
                                    $('#Date_Ref').datetimepicker({
                                        //sideBySide: true,
                                        timepicker:false,
                                        format:'Y-MM-DD',
                                    });
                                });
                            </script>

                        </div>

                        <button type="button" id="SearchBtn" class="btn btn-secondary mb-2 ">Filtrer</button>  
                        @if(Auth::user()->is_admin== true|| Auth::user()->onlyread  == true|| Auth::user()->TE_chipment== true)
                            <a href="{{ route('export') }}" class="btn btn-danger mb-2 mx-2 invisible mybtn"><i class="fa fa-download"></i> Exporter Vers Excel</a>
                        @endif
                    </form>
                    
            </div>
            <div class="col-md-2 text-right">
                    @if(Auth::user()->is_admin == true || Auth::user()->TE_chipment == true)
                        <a  href="{{ route('ajouter') }}" class="btn btn-primary mb-2">
                            <i class="fa fa-plus"></i> Ajouter
                        </a>
                    @endif
            </div>
        </div>
        
        <hr>
                
                <table class="table table-striped table-bordered display nowrap" id="table">
                        <thead>
                            <tr>
                                <th >action</th>

                                @if(Auth::user()->is_admin)
                                    <th >ajouter_par</th>
                                    <th>Tractionnaire_</th>
                                @elseif(Auth::user()->onlyread)
                                    <th>ajouter_par</th>
                                @endif
                                <th>RTS_time</th>
                                <th>Plate_Number</th>
                                <th>Van’s_type</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>RTS_request_Time</th>
                                <th>RTS_closing_Time</th>
                                <th>Positionning_time</th>
                                <th>Van_arrival_Time</th>
                                <th>Invoice_sharing_time</th>
                                <th>Warehouse_exit</th>
                                <th>Customs_Clearance</th>
                                <th>Port_exit</th>
                                <th>Arrival_Time</th>
                                <th>Unloading_time</th>
                                <th>Immobilisation_Loading</th>
                                <th>Immobilisation_Unloading</th>
                                <th>Comments_trspt_team</th>
                                <th>List_of_shipment_nbrs</th>
                                <th>Nbr_of_DNs</th>
                                <th>AEP_validation_Time</th>
                                <th>WH_comments</th>
                                <th>Transportation_comments</th>
                                <th>Poids_Taxable</th>
                                <th>Weight</th>
                                <th>Volume</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>


                <div class="modal bg-secondary" tabindex="-1" role="dialog" id="showmodal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-danger text-white">
                        <div class="modal-header">
                            <h5 class="modal-title">Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <p>Êtes-vous sûr ?</p>
                            </div>
                            <div class="modal-footer">
                            <form method="POST" action="{{ route('delete') }}">
                            @csrf
                            @method('DELETE')
                                <input type="hidden" name="idinput" id="idinput" value=""/>    
                                <button type="submit" class="btn btn-primary">Enregistrer</button>        
                            </form>
                                <button id="Close" type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <script type="application/javascript" >
                    $(document).on("click", ".open-Dialog", function () {
                        var id = $(this).data('id');
                        $("#idinput").val(id);
                        $('#showmodal').fadeIn(500);
                        $('#showmodal').modal('show');
                    });
                    // $("input[type="search"]").addClass("form-control");
                </script>

            </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

    var table = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "dataType": "json",
        "aaSorting": [],

        @if(Auth::user()->is_admin)
            "order": [[ 3, "desc" ]],
        @elseif(Auth::user()->onlyread)
            "order": [[ 2, "desc" ]],
        @else
            "order": [[ 1, "desc" ]],
        @endif

        "select": {
            "style": 'single'
        },
        "pageLength": 10,
        "lengthMenu": [5,10,25,50,100],
        "type": "POST",
        "ajax": {
            "url":'{{ route('index.Allrow') }}',
            "error": function (jqXHR, textStatus, errorThrown) {
                // Global
                if (jqXHR.status != 0)
                {
                    console.clear();
                    table.ajax.reload();
                }
            }
        },
        "columns": [
            { "data": "action"},
            @if(Auth::user()->is_admin)
                { "data": "ajouter_par","name":"users.name"},
                { "data": "Tractionnaire_","name":"u.name"},
            @elseif(Auth::user()->onlyread)
                { "data": "ajouter_par","name":"ajouter_par"},
            @endif
            { "data": "RTS_time"},
            { "data": "Plate_Number"},
            { "data": "Van’s_type"},
            { "data": "Origin"},
            { "data": "Destination"},
            { "data": "RTS_request_Time"},
            { "data": "RTS_closing_Time" },
            { "data": "Positionning_time"},
            { "data": "Van_arrival_Time" },
            { "data": "Invoice_sharing_time" },
            { "data": "Warehouse_exit" },
            { "data": "CustomsClearance" },
            { "data": "Port_exit" },
            { "data": "Arrival_Time" },
            { "data": "Unloading_time"},
            { "data": "Immobilisation_Loading"},
            { "data": "Immobilisation_Unloading"},
            { "data": "Comments_trspt_team" },
            { "data": "List_of_shipment_nbrs" },
            { "data": "Nbr_of_DNs" },
            { "data": "AEP_validation_Time"},
            { "data": "WH_comments" },
            { "data": "Transportation_comments" },
            { "data": "Weight" },
            { "data": "Volume" },
            { "data": "Poids_Taxable" }
        ],
        "scrollX": true,
        "searchDelay": 10,
        "language": {
            "url": "sources/French.json",
        },
    });

    $("#SearchBtn").click(function() {

        var date1 = $( "#Date1_Ref").val();
        var date2 = $( "#Date2_Ref" ).val();
        var urlpath = window.location.href;
        
        if(date1 != '' && date2 != '')
        {
            $(".invisible").removeClass('invisible');
            $('#table').DataTable().destroy();

            var table2 = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 10,
                "lengthMenu": [5,10,25,50,100],
                "dataType": "json",
                "aaSorting": [],
        
                @if(Auth::user()->is_admin)
                    "order": [[ 3, "desc" ]],
                @elseif(Auth::user()->onlyread)
                    "order": [[ 2, "desc" ]],
                @else
                    "order": [[ 1, "desc" ]],
                @endif

                "select": {
                    "style": 'single'
                },
                "language": {
                        url: "sources/French.json",
                    },
                "type": "POST",
                "ajax": {
                    "url": urlpath + "/search/" + date1 + "/" + date2,
                    "error": function (jqXHR, textStatus, errorThrown) {
                        // Global
                        if (jqXHR.status != 0)
                        {
                            console.clear();
                            table2.ajax.reload();
                        }
                    }
                },
                "columns": [
                    { "data": "action"},
                    @if(Auth::user()->is_admin)
                        { "data": "ajouter_par","name":"users.name"},
                        { "data": "Tractionnaire_","name":"u.name"},
                    @elseif(Auth::user()->onlyread)
                        { "data": "ajouter_par","name":"ajouter_par"},
                    @endif
                    { "data": "RTS_time" },
                    { "data": "Plate_Number" },
                    { "data": "Van’s_type" },
                    { "data": "Origin" },
                    { "data": "Destination" },
                    { "data": "RTS_request_Time" },
                    { "data": "RTS_closing_Time" },
                    { "data": "Positionning_time"},
                    { "data": "Van_arrival_Time" },
                    { "data": "Invoice_sharing_time" },
                    { "data": "Warehouse_exit" },
                    { "data": "CustomsClearance" },
                    { "data": "Port_exit" },
                    { "data": "Arrival_Time" },
                    { "data": "Unloading_time"},
                    { "data": "Immobilisation_Loading"},
                    { "data": "Immobilisation_Unloading"},
                    { "data": "Comments_trspt_team" },
                    { "data": "List_of_shipment_nbrs" },
                    { "data": "Nbr_of_DNs" },
                    { "data": "AEP_validation_Time"},
                    { "data": "WH_comments" },
                    { "data": "Transportation_comments" },
                    { "data": "Weight" },
                    { "data": "Volume" },
                    { "data": "Poids_Taxable" }],
                    "scrollX": true,
                    "searchDelay": 10,
            });
        }
    });
    
});    
</script>
@endsection