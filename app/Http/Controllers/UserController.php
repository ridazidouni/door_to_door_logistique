<?php

namespace App\Http\Controllers;

use App\User;
use App\SuiveTe;
use Illuminate\Http\Request;
use Auth;
use app\Http\Request\RequestName;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();

        $this->authorize('create',$user);

        return view('newuser');
    }


    public function listuser()
    {
        $user = Auth::user();

        $this->authorize('view',$user);

        $users = User::all();

        $users = DB::table('users as u')
        ->join('users as s', 'u.id', '=', 's.createby')
        ->select('s.*','u.email as ajouter_par')
        ->get();
        
        return view('listuser', [
            'users' => $users,
        ]);
    }


    public function reinitialiser($id,Request $request)
    {
        $this->authorize('update', Auth::user());

        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:1',
        ]);
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('listuser')->with('status','Opération terminée avec succès');
    }

    public function reinitialiserUserPassword($id)
    {
        $this->authorize('update', Auth::user());
        return view('reinitialiser',compact('id'));
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $this->authorize('create', Auth::user());

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:3',
        ]);

        $user = User::find($request->email);
        if($user)
        {
            $request->session()->flash('status','Cette adresse E-mail existe déjà');
            return redirect()->route('adduser');
        }
        else
        {
            
            $user = new User();
            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            
            if($request->checkinfo=='onlyread')
            {
                $user->onlyread = 1;
            }
            elseif($request->checkinfo=='TE_chipment')
            {
                $user->TE_chipment = 1;
            }
            elseif($request->checkinfo=='Tractionnaire')
            {
                $user->TE_chipment = 0;
                $user->onlyread = 0;
            }
            
            $user->createby = Auth::user()->id;
            
            $user->save();

            return redirect()->route('listuser')->with('status','Opération terminée avec succès');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('reinitialiser', Auth::user());
        return view('newpassword');
    }

    public function edituser($id)
    {
        $this->authorize('update', Auth::user());
        
        $user = User::find($id);
        $cheked = 'Tractionnaire';
        if($user && !$user->is_admin)
        {
            if($user->TE_chipment)
            {
                $cheked = 'TE_chipment';
            }
            elseif ($user->onlyread) 
            {
                $cheked = 'onlyread';
            }

            return view('edituser',compact('user','cheked'));
        }
        else
        {
            return redirect()->route('listuser');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('reinitialiser', Auth::user());

        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:1',
        ]);

        $user = User::find(auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin')->with('status','Opération terminée avec succès');
    }


    public function updateuser($id ,Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($id);

        if($user && !$user->is_admin)
        {
            $user->name = $request->name;
            $user->email = $request->email;
            
            if($request->checkinfo=='onlyread')
            {
                $user->onlyread = 1;
                $user->TE_chipment = 0;
            }
            elseif($request->checkinfo=='TE_chipment')
            {
                $user->TE_chipment = 1;
                $user->onlyread = 0;
            }
            elseif($request->checkinfo=='Tractionnaire')
            {
                $user->TE_chipment = 0;
                $user->onlyread = 0;
            }
            $user->save();
            return redirect()->route('listuser')->with('status','Opération terminée avec succès');
        }
        else
        {
            return redirect()->route('listuser');
        }

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $user = User::find($id->idinput);
        $check = SuiveTe::where('Tractionnaire',$user->id)->count();
        
        $this->authorize('delete',$user);

        if($check != 0)
        {
            return redirect()->route('listuser')->with('status','impossible supprimer cette utilisateur');
        }

        if($user && !$user->is_admin)
        {
            $user->delete();

            return redirect()->route('listuser')->with('status','Opération terminée avec succès');
        }
        else
        {
            return redirect()->route('listuser');
        }

    }
}
