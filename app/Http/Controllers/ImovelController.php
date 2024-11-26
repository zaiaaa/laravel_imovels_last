<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImovelRequest;
use App\Http\Requests\UpdateImovelRequest;
use App\Models\Imovel;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ImovelController extends Controller
{
    /**
     * Instantiate a new imovelController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-imovel|edit-imovel|delete-imovel', ['only' => ['index','show']]);
       $this->middleware('permission:create-imovel', ['only' => ['create','store']]);
       $this->middleware('permission:edit-imovel', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-imovel', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('imovels.index', [
            'imovels' => Imovel::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('imovels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(StoreImovelRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
             // put image in the public storage
            $filePath = Storage::disk('public')->put('images/imovels/fotos', request()->file('foto'));
            $validated['foto'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Imovel::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Post created successfully!');
            return redirect()->route('imovels.index');
        }

        return abort(500);
    }
    /**
     * Display the specified resource.
     */
    public function show(Imovel $imovel): View
    {
        return view('imovels.show', [
            'imovel' => $imovel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imovel $imovel): View
    {
        return view('imovels.edit', [
            'imovel' => $imovel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImovelRequest $request, string $id): RedirectResponse
    {
        $imovel = Imovel::findOrFail($id);
        $validated = $request->validated();
        
        if ($request->hasFile('foto')) {
            // delete image
            Storage::disk('public')->delete($imovel->foto);
            
            $filePath = Storage::disk('public')->put('images/imovels/fotos', request()->file('foto'), 'public');
            $validated['foto'] = $filePath;
        }
        
        $update = $imovel->update($validated);

        if($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('imovels.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $imovel = Imovel::findOrFail($id);

        Storage::disk('public')->delete($imovel->foto);
        
        $delete = $imovel->delete();

        if($delete) {
            session()->flash('notif.success', 'imovel deleted successfully!');
            return redirect()->route('imovels.index');
        }

        abort(500);
    }
}