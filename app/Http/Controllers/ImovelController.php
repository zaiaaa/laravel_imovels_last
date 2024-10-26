<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImovelRequest;
use App\Http\Requests\UpdateImovelRequest;
use App\Models\Imovel;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
        Imovel::create($request->all());
        return redirect()->route('imovels.index')
                ->withSuccess('New Imovel is added successfully.');
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
    public function update(UpdateImovelRequest $request, Imovel $imovel): RedirectResponse
    {
        $imovel->update($request->all());
        return redirect()->back()
                ->withSuccess('imovel is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imovel $imovel): RedirectResponse
    {
        $imovel->delete();
        return redirect()->route('imovels.index')
                ->withSuccess('imovel is deleted successfully.');
    }
}