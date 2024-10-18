<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        if ($query) {
            $annonces = Annonce::where('titre', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%")
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $annonces = Annonce::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('annonces.index', compact('annonces'));
    }



    public function create()
    {
        return view('annonces.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photo' => ['required', 'image'],
            'price' => ['required', 'numeric', 'max:1000000'],
        ]);

        $photo = $request->file('photo')->store('public/photos');
        $photoUrl = Storage::url($photo);
        $annonce = Annonce::create([
            'titre' => $validatedData['title'],
            'description' => $validatedData['description'],
            'photo' => $photoUrl,
            'prix' => $validatedData['price'],
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('annonces.show', $annonce);
    }

    public function show(Annonce $annonce)
    {
        return view('annonces.show', compact('annonce'));
    }

    public function edit(Annonce $annonce)
    {
        return view('annonces.edit', compact('annonce'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        $validatedData = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'photo' => ['nullable', 'image'],
            'prix' => ['required', 'numeric', 'max:1000000'],
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('public/photos');
            $photoUrl = Storage::url($photo);
            $annonce->photo = $photoUrl;
        }

        $annonce->titre = $validatedData['titre'];
        $annonce->description = $validatedData['description'];
        $annonce->prix = $validatedData['prix'];

        $annonce->save();

        return redirect()->route('annonces.show', $annonce);
    }

    public function destroy(Annonce $annonce)
    {
        $annonce->delete();

        return redirect()->route('annonces.index');
    }
}
