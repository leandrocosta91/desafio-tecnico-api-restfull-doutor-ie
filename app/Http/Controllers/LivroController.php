<?php

namespace App\Http\Controllers;

use App\Models\Indice;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Livro::query();

        if (!empty($request->titulo)) {
            $query->where('livros.titulo', 'like',  '%' . $request->titulo. '%');
        }

        if (!empty($request->titulo_do_indice)) {
            $query->join('indices', 'indices.livro_id', '=', 'livros.id');
            $query->where('indices.titulo', 'like',  '%' . $request->titulo_do_indice. '%');
        }
        
        $query->with(['user', 'indices.indices']);

        $query->distinct();

        $query->select(['indices.*', 'livros.*']);

        $query->orderBy("livros.titulo", "asc");

        $livros = $query->get();

        return $livros;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $livro = Livro::create([
            'usuario_publicador_id' => Auth::id(),
            'titulo' => $request->titulo
        ]);
        
        $indices = $request->indices;
        
        $this->store_indice($indices, $livro, null);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_indice(array $indices, Livro $livro, Indice $indice_pai = null)
    {
        
        foreach ($indices as $value) {
            // var_dump($value);
            $indice_novo = Indice::create([
                'livro_id' => $livro->id,
                'indice_pai' => is_null($indice_pai) ? null : $indice_pai->id,
                'titulo' => $value['titulo'],
                'pagina' => $value['pagina']
            ]);

            if ($value['subindices'] > 0) {
                $this->store_indice($value['subindices'], $livro, $indice_novo);
            }
        }
    }
}
