@extends('layouts.app')

@section('content')
<style>
textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {   
        border-color: rgb(255,0,0);
        box-shadow: 0 1px 1px rgb(255,0,0) inset, 0 0 8px rgb(255,0,0);
        outline: 0 none;
    }
</style>
<div class="container">
    <div class="row justify-content-center pt-4">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i>
                    {{ __('éditer') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update' , [ $request->id]  ) }}">
                        @csrf
                        @method('PUT')


                        @if(Auth::user()->is_admin)
                            <div class="form-group row">
                                <label for="Tractionnaire" class="col-md-4 col-form-label text-md-right">{{ __('Tractionnaire') }}</label>
                                <div class="col-md-6">
                                <select name="Tractionnaire" class="form-control {{ $disabled }}  @error('Tractionnaire') is-invalid @enderror" id="Tractionnaire">
                                        @foreach ($users as $user)
                                            @foreach ($user as $value)
                                                @if($value->id == $request->Tractionnaire)
                                                    <option selected value="{{ $value->id }}" >{{$value->name}}</option>
                                                @else
                                                    <option value="{{ $value->id }}" >{{$value->name}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('Tractionnaire')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
                        @endif

                        
                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}


                        <div class="form-group row">
                            <label for="RTS_time" class="col-md-4 col-form-label text-md-right">{{ __('RTS_time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="RTS_time" data-target-input="nearest">
                                <input type="text" name="RTS_time"  {{ $disabled }}  class="form-control datetimepicker-input" value="{{ old('RTS_time' , $request->RTS_time ) }}" data-target="#RTS_time"/>
                                <div class="input-group-append" data-target="#RTS_time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#RTS_time').datetimepicker();
                                });
                            </script>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Plate_Number" class="col-md-4 col-form-label text-md-right">{{ __('Plate_Number') }}</label>

                            <div class="col-md-6">
                                <input id="Plate_Number" type="text" {{ $disabled }}   name="Plate_Number" class="form-control @error('Plate_Number') is-invalid @enderror" value="{{ old('Plate_Number' , $request->Plate_Number ) }}">

                                @error('Plate_Number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Van’s_type" class="col-md-4 col-form-label text-md-right">{{ __('Van’s_type') }}</label>

                            <div class="col-md-6">
                                <select id="Van’s_type" {{ $disabled }} name="Van’s_type" class="form-control @error('Van’s_type') is-invalid @enderror" >
                                    <option selected value="S/R" >S/R</option>
                                    <option value="Taxi">Taxi</option>
                                    <option value="14 T" >14T</option>
                                    <option value="3.5 T">3.5 T</option>
                                </select>
                                @error('Van’s_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Origin" class="col-md-4 col-form-label text-md-right">{{ __('Origin') }}</label>

                            <div class="col-md-6">
                                <input id="Origin" type="text" name="Origin"  {{ $disabled }}   class="form-control @error('Origin') is-invalid @enderror" value="{{ old('Origin' , $request->Origin ) }}">

                                @error('Origin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Positionning_time" {{ $style }} class="col-md-4 col-form-label text-md-right">{{ __('Positionning_time') }}</label>

                            <div class="col-md-6">
                                <div class="input-group date" id="Positionning_time" data-target-input="nearest">
                                    <input type="text" name="Positionning_time"  class="form-control datetimepicker-input" value="{{ old('Positionning_time' , $request->Positionning_time ) }}" data-target="#Positionning_time"/>
                                    <div class="input-group-append" data-target="#Positionning_time" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('Positionning_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Positionning_time').datetimepicker();
                                });
                            </script>
                        </div>

                        
                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}
                        


                        <div class="form-group row">
                            <label for="Destination" class="col-md-4 col-form-label text-md-right">{{ __('Destination') }}</label>

                            <div class="col-md-6">
                                <input type="text" name="Destination" {{ $disabled }}   class="form-control   @error('Destination') is-invalid @enderror" value="{{ old('Destination' , $request->Destination ) }}"/>
                                @error('Destination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="RTS_request_Time" class="col-md-4 col-form-label text-md-right">{{ __('RTS_request_Time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="RTS_request_Time" data-target-input="nearest">
                                <input type="text" name="RTS_request_Time"  {{ $disabled }}  class="form-control datetimepicker-input" value="{{ old('RTS_request_Time' , $request->RTS_request_Time ) }}" data-target="#RTS_request_Time"/>
                                <div class="input-group-append" data-target="#RTS_request_Time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                                @error('RTS_request_Time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#RTS_request_Time').datetimepicker();
                                });
                            </script>
                        </div>

                        
                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="RTS_closing_Time" class="col-md-4 col-form-label text-md-right">{{ __('RTS_closing_Time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="RTS_closing_Time" data-target-input="nearest">
                                <input type="text" name="RTS_closing_Time" {{ $disabled }}   class="form-control datetimepicker-input" value="{{ old('RTS_closing_Time' , $request->RTS_closing_Time ) }}" data-target="#RTS_closing_Time"/>
                                <div class="input-group-append" data-target="#RTS_closing_Time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('RTS_closing_Time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#RTS_closing_Time').datetimepicker();
                                });
                            </script>
                        </div>

                        {{------------------------------------------------------------------------------ --}}
                        {{------------------------------------------------------------------------------ --}}

                        <div class="form-group row">
                            <label for="Van_arrival_Time" {{ $style }}  class="col-md-4 col-form-label text-md-right">{{ __('Van_arrival_Time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="Van_arrival_Time" data-target-input="nearest">
                                <input type="text" name="Van_arrival_Time"  class="form-control datetimepicker-input" value="{{ old('Van_arrival_Time' , $request->Van_arrival_Time ) }}" data-target="#Van_arrival_Time"/>
                                <div class="input-group-append" data-target="#Van_arrival_Time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Van_arrival_Time').datetimepicker();
                                });
                            </script>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Invoice_sharing_time" class="col-md-4 col-form-label text-md-right">{{ __('Invoice_sharing_time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="Invoice_sharing_time" data-target-input="nearest">
                                <input type="text" name="Invoice_sharing_time" {{ $disabled }}   class="form-control datetimepicker-input" value="{{ old('Invoice_sharing_time' , $request->Invoice_sharing_time ) }}" data-target="#Invoice_sharing_time"/>
                                <div class="input-group-append" data-target="#Invoice_sharing_time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('Invoice_sharing_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Invoice_sharing_time').datetimepicker();
                                });
                            </script>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}
                        

                        <div class="form-group row">
                            <label for="WareHouse_Exit" {{ $style }}  class="col-md-4 col-form-label text-md-right">{{ __('WareHouse_Exit') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="WareHouse_Exit" data-target-input="nearest">
                                <input type="text" name="Warehouse_exit" class="form-control datetimepicker-input" value="{{ old('Warehouse_exit' , $request->Warehouse_exit ) }}" data-target="#Warehouse_exit"/>
                                <div class="input-group-append" data-target="#WareHouse_Exit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('Warehouse_exit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Warehouse_exit').datetimepicker();
                                });
                            </script>
                        </div>
                        
                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}
                        
                        <div class="form-group row">
                            <label for="CustomsClearance"  {{ $style }} class="col-md-4 col-form-label text-md-right">{{ __('CustomsClearance') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="CustomsClearance" data-target-input="nearest">
                                <input type="text" name="CustomsClearance"  class="form-control datetimepicker-input" value="{{ old('CustomsClearance' , $request->CustomsClearance ) }}" data-target="#CustomsClearance"/>
                                <div class="input-group-append" data-target="#CustomsClearance" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('CustomsClearance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#CustomsClearance').datetimepicker();
                                });
                            </script>

                        </div>


                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Port_exit" {{ $style }}  class="col-md-4 col-form-label text-md-right">{{ __('Port_exit') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="Port_exit" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"   data-target="#Port_exit" name="Port_exit" value="{{ old('Port_exit', $request->Port_exit ) }}" />
                                <div class="input-group-append" data-target="#Port_exit" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('Port_exit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Port_exit').datetimepicker();
                                });
                            </script>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}
                        
                        <div class="form-group row">
                            <label for="Arrival_Time" class="col-md-4 col-form-label text-md-right">{{ __('Arrival_Time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="Arrival_Time" data-target-input="nearest">
                                <input type="text" name="Arrival_Time"  {{ $disabled }}  class="form-control datetimepicker-input" data-target="#Arrival_Time" value="{{ old('Arrival_Time', $request->Arrival_Time ) }}"  />
                                <div class="input-group-append" data-target="#Arrival_Time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Arrival_Time').datetimepicker();
                                });
                            </script>
                        </div>


                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Unloading_time" class="col-md-4 col-form-label text-md-right">{{ __('Unloading_time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="Unloading_time" data-target-input="nearest">
                                <input type="text" name="Unloading_time"  {{ $disabled }}   class="form-control datetimepicker-input" data-target="#Unloading_time" value="{{ old('Unloading_time', $request->Unloading_time ) }}"  />
                                <div class="input-group-append" data-target="#Unloading_time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('Unloading_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Unloading_time').datetimepicker();
                                });
                            </script>
                        </div>
                        
                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Immobilisation_Loading" class="col-md-4 col-form-label text-md-right">{{ __('Immobilisation_Loading') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="Immobilisation_Loading" data-target-input="nearest">
                                <input type="text" name="Immobilisation_Loading" {{ $disabled }}   class="form-control datetimepicker-input" data-target="#Immobilisation_Loading" value="{{ old('Immobilisation_Loading', $request->Immobilisation_Loading ) }}"  />
                                <div class="input-group-append" data-target="#Immobilisation_Loading" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('Immobilisation_Loading')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Immobilisation_Loading').datetimepicker();
                                });
                            </script>
                        </div>
                        
                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Immobilisation_Unloading" class="col-md-4 col-form-label text-md-right">{{ __('Immobilisation_Unloading') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="Immobilisation_Unloading" data-target-input="nearest">
                                <input type="text" name="Immobilisation_Unloading" {{ $disabled }}   class="form-control datetimepicker-input" data-target="#Immobilisation_Unloading" value="{{ old('Immobilisation_Unloading', $request->Immobilisation_Unloading ) }}"  />                                <div class="input-group-append" data-target="#Immobilisation_Unloading" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('Immobilisation_Unloading')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#Immobilisation_Unloading').datetimepicker();
                                });
                            </script>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}
                        
                        <div class="form-group row">
                            <label for="Comments_trspt_team" class="col-md-4 col-form-label text-md-right">{{ __('Comments_trspt_team') }}</label>

                            <div class="col-md-6">
                                <textarea name="Comments_trspt_team" {{ $disabled }}  id="Comments_trspt_team" class="form-control" rows="5" id="Commentaire">{{ old('Comments_trspt_team', $request->Comments_trspt_team) }}</textarea>
                                @error('Comments_trspt_team')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="List_of_shipment_nbrs" class="col-md-4 col-form-label text-md-right">{{ __('List_of_shipment_nbrs') }}</label>

                            <div class="col-md-6">
                                <input id="List_of_shipment_nbrs" type="text" {{ $disabled }}  class="form-control @error('List_of_shipment_nbrs') is-invalid @enderror" name="List_of_shipment_nbrs" value="{{ old('List_of_shipment_nbrs', $request->List_of_shipment_nbrs) }}">

                                @error('List_of_shipment_nbrs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Nbr_of_DNs" class="col-md-4 col-form-label text-md-right">{{ __('Nbr_of_DNs') }}</label>

                            <div class="col-md-6">
                                <input id="Nbr_of_DNs" type="text" {{ $disabled }}  class="form-control @error('Nbr_of_DNs') is-invalid @enderror" name="Nbr_of_DNs" value="{{ old('Nbr_of_DNs', $request->Nbr_of_DNs) }}">

                                @error('Nbr_of_DNs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="AEP_validation_Time" class="col-md-4 col-form-label text-md-right">{{ __('AEP_validation_Time') }}</label>

                            <div class="col-md-6">
                            <div class="input-group date" id="AEP_validation_Time" data-target-input="nearest">
                                <input type="text" name="AEP_validation_Time" {{ $disabled }}   class="form-control datetimepicker-input" data-target="#AEP_validation_Time" value="{{ old('AEP_validation_Time', $request->AEP_validation_Time) }}"/>
                                <div class="input-group-append" data-target="#AEP_validation_Time" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                                @error('AEP_validation_Time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <script type="application/javascript">
                                $(function () {
                                    $('#AEP_validation_Time').datetimepicker();
                                });
                            </script>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="WH_comments" class="col-md-4 col-form-label text-md-right">{{ __('WH_comments') }}</label>

                            <div class="col-md-6">
                            <textarea id="WH_comments" name="WH_comments" {{ $disabled }}   class="form-control" rows="5" id="WH_comments" value="{{ old('WH_comments') }}">{{$request->WH_comments}}</textarea>
                                @error('WH_comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}
                        
                        <div class="form-group row">
                            <label for="Transportation_comments" class="col-md-4 col-form-label text-md-right">{{ __('Transportation_comments') }}</label>

                            <div class="col-md-6">
                            <textarea id="Transportation_comments" {{ $disabled }}   name="Transportation_comments" class="form-control" rows="5" id="Transportation_comments" value="{{ old('Transportation_comments') }}">{{$request->Transportation_comments}}</textarea>
                                @error('Transportation_comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------- --}}
                        {{-- ---------------------------------------------------------------------------- --}}

                        <div class="form-group row">
                            <label for="Weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>

                            <div class="col-md-6">
                                <input id="Weight" type="text" {{ $disabled }}   class="form-control @error('Weight') is-invalid @enderror" name="Weight" value="{{ old('Weight', $request->Weight) }}">

                                @error('Weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Volume" class="col-md-4 col-form-label text-md-right">{{ __('Volume') }}</label>

                            <div class="col-md-6">
                                <input id="Volume" type="text"  {{ $disabled }}  class="form-control @error('Volume') is-invalid @enderror" name="Volume" value="{{ old('Volume', $request->Volume) }}">

                                @error('Volume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Poids_Taxable" class="col-md-4 col-form-label text-md-right">{{ __('Poids_Taxable') }}</label>

                            <div class="col-md-6">
                                <input id="Poids_Taxable" type="text" {{ $disabled }}   class="form-control @error('Poids_Taxable') is-invalid @enderror" name="Poids_Taxable" value="{{ old('Poids_Taxable' , $request->Poids_Taxable) }}">

                                @error('Poids_Taxable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button  type="submit" class="btn btn-danger">
                                    <i class="fa fa-refresh" aria-hidden="true"></i>
                                    {{ __('Modifier') }}
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
