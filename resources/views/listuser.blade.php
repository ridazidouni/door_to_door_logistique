@extends('layouts.app')

@section('content')

<style>
            
    .btn-sml {
        padding: 5px 5px;
        font-size: 14px;
        border-radius: 1px;
    }
    @media (max-width: 600px) {
        .btn-primary {
            width: 100%;
        }
    }
    .table thead{
        width: 100%
    }


</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            language: {
                url: "https:////cdn.datatables.net/plug-ins/1.10.20/i18n/French.json",
            },
            "pageLength": 25,
            "responsive": true
        });
    });
</script>
<div class="container">
    <div class="row justify-content-center pt-4">
        <div class="col-md-12">

        <div class="row my-4">
            <div class="col-md-6">
                <h2>Liste des Utilisateurs</h2>
            </div>
            @if(Auth::user()->is_admin)
                <div class="col-md-6 text-right">
                    <a  href="{{ route('adduser') }}" class="btn btn-primary mb-2">
                        <i class="fa fa-plus"></i> Ajouter un Utilisateur
                    </a>
                </div>
            @endif
        </div>

        @if(session()->has('status'))
            <div class="row justify-content-center">
                <div class="alert alert-success" role="alert">
                    {{ session()->get('status') }}
                </div>
            </div>
        @endif
            
        <hr>


            <table class="table display nowrap table-striped table-bordered" id="table" >
                <thead>
                    <tr>
                        <th scope="col">
                            @if(Auth::user()->is_admin)
                                action
                            @endif
                        </th>
                        <th>Nom Utilisateur</th>
                        <th>Email</th>
                        <th>ajouter_par</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if(!$user->is_admin && Auth::user()->is_admin)
                                    <a href="{{ route('edituser' , ['id' => $user->id] ) }}" class="btn-sml btn btn-danger"><i class="fa fa-edit"></i></a>
                                    <a type="button" class="btn-sml open-Dialog btn btn-success" data-id="{{ $user->id }}"><i class="fa fa-trash"></i></a>
                                    <a href="{{ route('reinitialiserUserPassword' , ['id' => $user->id] ) }}" class="btn-sml btn btn-warning"><i class="fa fa-key"></i></a></a>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->email == 'admin@sjl-group.com')
                                    par défaut
                                @else
                                    {{ $user->ajouter_par }}
                                @endif
                            </td>
                            <td>
                                @if($user->is_admin)
                                    admin
                                @elseif($user->onlyread)
                                    lecture seulement
                                @elseif($user->TE_chipment)
                                    TE_Shipment
                                @else
                                    Tractionnaire
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>

                {{-- delete --}}
                <div class="modal bg-secondary" tabindex="-1" role="dialog" id="showmodal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-danger text-white">
                        <div class="modal-header">
                            <h5 class="modal-title">Supprimer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>un
                            </button>
                        </div>
                        
                            <div class="modal-body">
                                <p>Êtes-vous sûr ?</p>
                                
                            </div>
                            <div class="modal-footer">
                            <form method="POST" action="{{ route('deleteuser') }}">
                            @csrf
                            @method('DELETE')
                                <input type="hidden" name="idinput" id="idinput" value=""/>    
                                <button type="submit" type="button" class="btn btn-primary">Enregistrer</button>        
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
                    
                    $("#Close").click(function () {
                        $("#showmodal").modal("hide");
                    });
                </script>


            </div>
        </div>
        </div>
    </div>
</div>
@endsection