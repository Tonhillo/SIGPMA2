<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateespecieRequest;
use App\Http\Requests\UpdateespecieRequest;
use App\Repositories\especieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use File;
use Storage;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class especieController extends AppBaseController
{
    /** @var  especieRepository */
    private $especieRepository;

    public function __construct(especieRepository $especieRepo)
    {
        $this->especieRepository = $especieRepo;
    }

    /**
     * Display a listing of the especie.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->especieRepository->pushCriteria(new RequestCriteria($request));
        $especies = $this->especieRepository->all();

        $currentPage = Paginator::resolveCurrentPage() - 1;
        $perPage = 10;
        $currentPageSearchResults = $especies->slice($currentPage * $perPage, $perPage)->all();
        $especies = new LengthAwarePaginator($currentPageSearchResults, count($especies), $perPage);

        return view('especies.index')
            ->with('especies', $especies);
    }

    /**
     * Show the form for creating a new especie.
     *
     * @return Response
     */
    public function create()
    {
      return view('especies.create');
    }

    /**
     * Store a newly created especie in storage.
     *
     * @param CreateespecieRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreateespecieRequest $request)
    {
        $input = $request->all();

        if( $request->hasFile('imagen_url') ) {//Se guarda la imagen en el directorio public/pucblic/img/especies
        $img=$request->file('imagen_url');
        $folderPath="public/img/especies/";
//        $fileName=$folderPath . $img->getClientOriginalName();//se define un nombre y el path a guardar en la BD
         $fileName = $folderPath . date("Y-m-d"). time() .'.'. $img->getClientOriginalExtension();
        $img->move('public/img/especies', $fileName);//Se guarda la img
    }
        $input['imagen_url']=$fileName;
        $especie = $this->especieRepository->create($input);

        Flash::success('La especie se ha guardado correctamente.');

        return redirect(route('especies.index'));
    }

    /**
     * Display the specified especie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $especie = $this->especieRepository->findWithoutFail($id);

        if (empty($especie)) {
            Flash::error('Especie no encontrada');

            return redirect(route('especies.index'));
        }

        return view('especies.show')->with('especie', $especie);
    }

    /**
     * Show the form for editing the specified especie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $especie = $this->especieRepository->findWithoutFail($id);

        if (empty($especie)) {
            Flash::error('Especie no encontrada');

            return redirect(route('especies.index'));
        }
        $url_img=$especie['imagen_url'];
        return view('especies.edit')->with('especie', $especie);
    }

    /**
     * Update the specified especie in storage.
     *
     * @param  int $id
     * @param UpdateespecieRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdateespecieRequest $request)
    {
        $especie = $this->especieRepository->findWithoutFail($id);
        $input = $request->all();
        if (empty($especie)) {
            Flash::error('Especie no encontrada');

            return redirect(route('especies.index'));
        }

        if( $request->hasFile('imagen_url') ) {//SI existe una imagen nueva se agrega y elimina la anterior
              $img=$request->file('imagen_url');
                $folderPath="public/img/especies/";
                $fileName = $folderPath . date("Y-m-d"). time() .'.'. $img->getClientOriginalExtension();
                  $img->move('public/img/especies', $fileName);
                    $input['imagen_url']=$fileName;
                      $image_path = $especie->imagen_url;
              if (File::exists($image_path)) {
                    File::Delete($image_path);
                  }

        }else{//si no, se asigna el valor de la antigua nuevamente ya que viene null
          $input['imagen_url']=$especie['imagen_url'];
        }
        $especie = $this->especieRepository->update($input, $id);

        Flash::success('Especie modificada correctamente.');

        return redirect(route('especies.index'));
    }

    /**
     * Remove the specified especie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $especie = $this->especieRepository->findWithoutFail($id);

        if (empty($especie)) {
            Flash::error('Especie no encontrada');

            return redirect(route('especies.index'));
        }
        $image_path = $especie->imagen_url;
        if (File::exists($image_path)) {//Se elimina el archivo si se elimina la especie
              File::Delete($image_path);
            }

        $this->especieRepository->delete($id);

        Flash::success('Especie eliminada correctamente.');

        return redirect(route('especies.index'));
    }
}
