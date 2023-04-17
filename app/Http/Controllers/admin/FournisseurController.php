<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailFournisseur;
use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseur::withCount('pieces')->latest()->paginate();

        return view('admin.fournisseurs.index',[
            'fournisseurs' => $fournisseurs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1- validation de la requête (formulaire)
        $validated = $request->validate([
            "nom" => 'required|max:255|unique:fournisseurs',
            "adresse" => 'required|max:255',
            "logo" => 'required|image|max:2048',
            'user_name' => 'required|max:255',
            'user_email' => 'required|email|unique:users,email'
        ]);
        
        // 2- Créer l'utilisateur:
        $password = Str::random(10);
        $user = new User();
        $user->name = $validated['user_name'];
        $user->email = $validated['user_email'];
        $user->password = Hash::make($password);
        $user->role = "fournisseur";
        $user->save();

        $validated['user_id'] = $user->id;


        // 3- Uploader le logo
        if($request->hasFile('logo')){
            $logo_path = $request->file('logo')->store('images',"public");
            $validated['logo'] = "/storage/$logo_path";
        }

        // 4- Créer une nouveau fournisseur
        Fournisseur::create($validated);

        // 5- Envoyer Email à $user
        Mail::to($user->email)->send(new SendEmailFournisseur($user,$password));
        // 6- redériger vers la liste des fournisseurs
        return redirect('/admin/fournisseurs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('admin.fournisseurs.edit',[
            "fournisseur" => $fournisseur
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        // 1- validation de la requête (formulaire)
        $validated = $request->validate([
            "nom" => [
                'required',
                'max:255',
                Rule::unique('fournisseurs')->ignore($fournisseur->id)
            ],
            "adresse" => 'required|max:255',
            "logo" => 'nullable|image|max:2048'
        ]);

        // 2- Uploader le logo
        if($request->hasFile('logo')){
            $logo_path = $request->file('logo')->store('images',"public");
            $validated['logo'] = "/storage/$logo_path";
        }

        // 3- mettre à jour le fournisseur
        $fournisseur->update($validated);

        // 4- redériger vers la liste des fournisseurs
        return redirect('/admin/fournisseurs');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fournisseur $fournisseur)
    { 
        $fournisseur->delete();
        return redirect('/admin/fournisseurs');
    }
}
