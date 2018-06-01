<?php

namespace App\Http\Controllers;

use App\personne;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function affichageLogin()
    {
        return view('login');
    }

    public function traitementLogin()
    {
        $mailentre = request('mail');
        $MDPentre = request('password');
        $count = personne::where('mail_personne',$mailentre)->count();
        if ($count != 1)
        {
            return back()->withInput()->withErrors([
                'mail' => 'Vos identifiants ne sont pas corrects'
            ]);
        }
        $MDPbase = personne::where('mail_personne', $mailentre)->get()[0];
        //return view('/index');
        //dd(dump($MDPbase->attributes['MDP']));
        if ($MDPentre == $MDPbase->password_personne) {
            //dd(dump($MDPbase["MDP"]));
            //Session::flush();
            //return redirect('/index');
            //dd(var_dump($MDPbase));
            $prenom = personne::select('prenom')->where('mail_personne', $mailentre)->get()[0];
            $nom = personne::select('Nom')->where('mail_personne', $mailentre)->get()[0];
            $id_user = personne::select('id_personne')->where('mail_personne', $mailentre)->get()[0];
            $statut = personne::select('droit_acces')->where('mail_personne', $mailentre)->get()[0];

            //on stocke dans la sessions les infos de l'utilisateur
            session::put('personne.prenom', $prenom->prenom);
            session::put('personne.nom', $nom->Nom);
            session::put('personne.id_User', $id_user->id_personne);
            session::put('personne.statut', $statut->droit_acces);


            return redirect('/');
        } else {
            return back()->withInput()->withErrors([
                'mail' => 'Vos identifiants ne sont pas corrects'
            ]);
        }
    }
}