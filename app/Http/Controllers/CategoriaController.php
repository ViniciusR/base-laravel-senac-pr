<?php

namespace App\Http\Controllers;

use App\Http\Resources\Categoria as CategoriaResource;
use App\Http\Requests\CategoriaRequest;
use App\Repositories\CategoriaRepository;
use App\Repositories\Criterias\Common\Where;

class CategoriaController extends Controller
{
    /**
     * Instantiate a new CategoriaController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categoria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request, CategoriaRepository $categoriaRepository)
    {
        $data = $request->all();

        if ($categoria = $categoriaRepository->create($data)) {
                return redirect()
                        ->route('categorias.edit', $categoria->id)
                        ->with('success', 'Categoria cadastrada com sucesso!');
        } else {
            return redirect()
                    ->back()
                    ->withErrors('Ocorreu um erro ao cadastrar a categoria. Por favor, tente novamente.')
                    ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaRepository $categoriaRepository, $id)
    {
        $categoria = $categoriaRepository->find($id);

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, CategoriaRepository $categoriaRepository, $id)
    {
        $data = $request->all();
        $categoriaRepository->update($id, $data);

        return redirect()
            ->route('categorias.edit', $id)
            ->with('success', 'Categoria alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaRepository $categoriaRepository, $id)
    {
        try {
            $categoriaRepository->delete($id);

            return response()->json(['type' => 'success', 'message' => 'Categoria excluída com sucesso!'], 201);
        } catch (\Exception $e) {
            return response()->json(['type' => 'error', 'message' => 'Ocorreu um erro ao excluir o registro.'], 500);
        }
    }
    
    public function getPagination($pagination)
    {
        $criterias = collect();

        if (request('busca_codigo')) {
            $criterias->push(new Where('codigo', request('busca_codigo')));
        }

        $pagination
            ->repository(CategoriaRepository::class)
            ->criterias($criterias)
            ->resource(CategoriaResource::class);
    }
}
