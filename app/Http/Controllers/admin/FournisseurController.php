<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NotifyFournisseurNewAccountJob;
use App\Mail\NewFournisseurEmail;
use App\Models\Fournisseur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            "logo" => 'nullable|image|max:2048',
            "user_name" => 'required|max:255',
            "user_email" => 'required|email|unique:users,email'
        ]);

        // 2- créer User:
        $password = Str::random(10);
        $user = User::create([
            'name' => $validated['user_name'],
            'email' => $validated['user_email'],
            'password' => Hash::make($password)
        ]);
        $user->role = 'fournisseur';
        $user->save();
        $validated['user_id'] = $user->id;

        // 3- uploader le logo 
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('images','public');
            $validated['logo'] = $path;
        }

        // 4- Créer une nouveau fournisseur
        $fournisseur = Fournisseur::create($validated);

        // 5- planifier l'envoie de l'email
        // $delay = now()->addMinutes(env('NEW_FOURNISSEUR_JOB_DELAY'));
        $delay = now()->addMinutes(config('settings.new_fournisseur_job_delay'));
        NotifyFournisseurNewAccountJob::dispatch($user, $fournisseur, $password)
            ->delay($delay);

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

        // 2- uploader le logo 
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('images','public');
            $validated['logo'] = $path;
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
