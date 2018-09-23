<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatealimentosRequest;
use App\Http\Requests\UpdatealimentosRequest;
use App\Repositories\alimentosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class alimentosController extends AppBaseController
{
    /** @var  alimentosRepository */
    private $alimentosRepository;

    public function __construct(alimentosRepository $alimentosRepo)
    {
        $this->alimentosRepository = $alimentosRepo;
    }

    /**
     * Display a listing of the alimentos.
     *
     * @param Request $request
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(Request $request)
    {
        $this->alimentosRepository->pushCriteria(new RequestCriteria($request));
        $alimentos = $this->alimentosRepository->all();
        $currentPage = Paginator::resolveCurrentPage() - 1;
        $perPage = 10;
        $currentPageSearchResults = $alimentos->slice($currentPage * $perPage, $perPage)->all();
        $alimentos = new LengthAwarePaginator($currentPageSearchResults, count($alimentos), $perPage);
        return view('alimentos.index')
            ->with('alimentos', $alimentos);
    }

    /**
     * Show the form for creating a new alimentos.
     *
     * @return Response
     */
    public function create()
    {
        return view('alimentos.create');
    }

    /**
     * Store a newly created alimentos in storage.
     *
     * @param CreatealimentosRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreatealimentosRequest $request)
    {
        $input = $request->all();

        $alimentos = $this->alimentosRepository->create($input);

        Flash::success('Alimentos saved successfully.');

        return redirect(route('alimentos.index'));
    }

    /**
     * Display the specified alimentos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $alimentos = $this->alimentosRepository->findWithoutFail($id);

        if (empty($alimentos)) {
            Flash::error('Alimentos not found');

            return redirect(route('alimentos.index'));
        }

        return view('alimentos.show')->with('alimentos', $alimentos);
    }

    /**
     * Show the form for editing the specified alimentos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $alimentos = $this->alimentosRepository->findWithoutFail($id);

        if (empty($alimentos)) {
            Flash::error('Alimentos not found');

            return redirect(route('alimentos.index'));
        }

        return view('alimentos.edit')->with('alimentos', $alimentos);
    }

    /**
     * Update the specified alimentos in storage.
     *
     * @param  int $id
     * @param UpdatealimentosRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdatealimentosRequest $request)
    {
        $alimentos = $this->alimentosRepository->findWithoutFail($id);

        if (empty($alimentos)) {
            Flash::error('Alimentos not found');

            return redirect(route('alimentos.index'));
        }

        $alimentos = $this->alimentosRepository->update($request->all(), $id);

        Flash::success('Alimentos updated successfully.');

        return redirect(route('alimentos.index'));
    }

    /**
     * Remove the specified alimentos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $alimentos = $this->alimentosRepository->findWithoutFail($id);

        if (empty($alimentos)) {
            Flash::error('Alimentos not found');

            return redirect(route('alimentos.index'));
        }

        $this->alimentosRepository->delete($id);

        Flash::success('Alimentos deleted successfully.');

        return redirect(route('alimentos.index'));
    }
}
