@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 my-4 border border-success py-4 bg-warning">
            <h4>Statistics des Tractionnaires</h3>
            <div>
                {{ $chart->container() }}
            </div>
        </div>
        
        <div class="col-md-8 mt-4 border border-success py-4 bg-warning">
            <h4>Statistics de Application à partir de {{ $today }} jusqu'à aujourd'hui</h3>
            <div>
                {{ $chartdays->container() }}
            </div>
        </div>
    </div>
</div>
</div>
{{ $chart->script() }}
{{ $chartdays->script() }}
@endsection
