<?php

namespace App\Http\Controllers;

use App\Models\UkmOrmawa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class UkmOrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UkmOrmawa::where();

        if ($request->filled('search_name')) {
            $query->where('name', 'like', '%' . $request->search_name . '%');
        }
        
        if ($request->filled('filter_type')) {
            $query->where('type', $request->filter_type);
        }

        if ($request->filled('filter_category')) {
            $query->where('category', $request->filter_category);
        }
        
        $ukmOrmawas = $query->orderBy('name')->paginate(9);

        return view('ukm-ormawa.index', compact('ukmOrmawas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->createdUkmOrmawa) {
            return redirect()->route('pengelola.ukm-ormawa.edit')->with('info', 'Anda sudah mengelola UKM/Ormawa. Silakan edit data yang sudah ada.');
        }
        return view('pengelola.ukm-ormawa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:ukm_ormawas,nama',
            'tipe' => 'required|in:UKM,Ormawa',
            'kategori' => 'required|in:Kesenian & Budaya,Olahraga,Penalaran,Kerohanian,Sosial',
            'deskripsi' => 'required|string|max:5000',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'kontak_email' => 'required|email|max:255',
            'kontak_instagram' => 'required|string|max:255',
            'logo_url' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'banner_url' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'id_provinsi' => 'nullable|string',
            'nama_provinsi' => 'nullable|string',
            'id_kabkota' => 'nullable|string',
            'nama_kabkota' => 'nullable|string',
            'id_kecamatan' => 'nullable|string',
            'nama_kecamatan' => 'nullable|string',
            'id_keldesa' => 'nullable|string',
            'nama_keldesa' => 'nullable|string',
            'alamat_jalan' => 'nullable|string|max:500',
        ]);

        $dataToCreate = $validated;
        $dataToCreate['slug'] = Str::slug($validated['nama']);
        $dataToCreate['user_id'] = Auth::id();

        if ($request->hasFile('logo_url')) {
            $dataToCreate['logo_url'] = $request->file('logo_url')->store('ukm_logos', 'public');
        }

        if ($request->hasFile('banner_url')) {
            $dataToCreate['banner_url'] = $request->file('banner_url')->store('ukm_banners', 'public');
        }   

        if ($request->filled('misi')) {
            $misiArray = array_filter(array_map('trim', explode("\n", $validated['misi'])));
            $dataToCreate['misi'] = $misiArray;
        } else {
            $dataToCreate['misi'] = [];
        }

        unset($dataToCreate['misi'], $dataToCreate['logo_url'], $dataToCreate['banner_url']);

        Auth::user()->createdUkmOrmawa->create($dataToCreate);

        return redirect()->route('pengelola.ukm-ormawa.edit')->with('success', 'Profil UKM/Ormawa berhasil dibuat dan diajukan untuk verifikasi.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $item = UkmOrmawa::where('slug', $slug)
                        ->firstOrFail();

        return view('ukm-ormawa.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        
        $ukmOrmawa = Auth::user()->createdUkmOrmawa->firstOrFail();
        
        return view('pengelola.ukm-ormawa.edit', compact('ukmOrmawa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $ukmOrmawa = Auth::user()->createdUkmOrmawa->firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:ukm_ormawas,nama,' . $ukmOrmawa->id,
            'tipe' => 'required|in:UKM,Ormawa',
            'kategori' => 'required|in:Kesenian & Budaya,Olahraga,Penalaran,Kerohanian,Sosial',
            'deskripsi' => 'required|string|max:5000',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'kontak_email' => 'required|email|max:255',
            'kontak_instagram' => 'required|string|max:255',
            'logo_url' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'banner_url' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'id_provinsi' => 'nullable|string',
            'nama_provinsi' => 'nullable|string',
            'id_kabkota' => 'nullable|string',
            'nama_kabkota' => 'nullable|string',
            'id_kecamatan' => 'nullable|string',
            'nama_kecamatan' => 'nullable|string',
            'id_keldesa' => 'nullable|string',
            'nama_keldesa' => 'nullable|string',
            'alamat_jalan' => 'nullable|string|max:500',
        ]);

        $dataToUpdate = $validated;

        $dataToUpdate['slug'] = Str::slug($validated['nama']);

        if ($request->hasFile('logo_url')) {
            if ($ukmOrmawa->logo_url && Storage::disk('public')->exists($ukmOrmawa->logo_url)) {
                Storage::disk('public')->delete($ukmOrmawa->logo_url);
            }
            $dataToUpdate['logo_url'] = $request->file('logo_url')->store('ukm_logos', 'public');
        }

        if ($request->hasFile('banner_url')) {
            if ($ukmOrmawa->banner_url && Storage::disk('public')->exists($ukmOrmawa->banner_url)) {
                Storage::disk('public')->delete($ukmOrmawa->banner_url);
            }
            $dataToUpdate['banner_url'] = $request->file('banner_url')->store('ukm_banners', 'public');
        }

        if ($request->filled('misi')) {
            $misiArray = array_filter(array_map('trim', explode("\n", $validated['misi'])));
            $dataToUpdate['misi'] = $misiArray;
        } else {
            $dataToUpdate['misi'] = [];
        }
        
        unset($dataToUpdate['misi'], $dataToUpdate['logo_url'], $dataToUpdate['banner_url']);
        
        $ukmOrmawa->update($dataToUpdate);

        return redirect()->route('pengelola.ukm-ormawa.edit')->with('success', 'Profil UKM/Ormawa berhasil diperbarui dan diajukan untuk verifikasi ulang.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UkmOrmawa $ukmOrmawa)
    {
        if ($ukmOrmawa->logo_url && Storage::disk('public')->exists($ukmOrmawa->logo_url)) {
            Storage::disk('public')->delete($ukmOrmawa->logo_url);
        }
        if ($ukmOrmawa->banner_url && Storage::disk('public')->exists($ukmOrmawa->banner_url)) {
            Storage::disk('public')->delete($ukmOrmawa->banner_url);
        }

        if ($ukmOrmawa->pengelola) {
            $ukmOrmawa->pengelola->manages_ukm_ormawa_id = null;
            $ukmOrmawa->pengelola->save();
        }
        
        $ukmOrmawa->delete();

        return redirect()->route('pengelola.ukm-ormawa.create')->with('success', 'UKM/Ormawa berhasil dihapus.');
    }
}
