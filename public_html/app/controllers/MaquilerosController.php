<?php

use Illuminate\Http\Request;

class MaquilerosController extends \BaseController
{
    protected $maquilero;
    protected $request;

    public function __construct(Maquilero $maquilero, Request $request)
    {
        $this->maquilero = $maquilero;
        $this->request   = $request;
        //$this->route     = $route;
        $this->beforeFilter('@findMaquilero', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    public function findMaquilero()
    {
        $this->maquilero = $this->maquilero->findOrFail(Route::current()->getParameter('maquileros'));
    }

	/**
	 * Display a listing of maquileros
	 *
	 * @return Response
	 */
    public function index()
    {
        return View::make('dashboard.maquileros.index')->with('maquileros', $this->maquilero->all());
    }

	/**
	 * Show the form for creating a new maquilero
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('dashboard.maquileros.create');
	}

	/**
	 * Store a newly created maquilero in storage.
	 *
	 * @return Response
	 */
    public function store()
    {
        $validator = Validator::make($this->request->all(), Maquilero::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $this->maquilero->create($this->request->all());

        return Redirect::route('maquileros.index')
                        ->with('msg', 'Datos guardados con exito.')
                        ->with('class', 'success');
    }

	/**
	 * Display the specified maquilero.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		//$maquilero = Maquilero::findOrFail($id);

		// return View::make('dashboard.maquileros.show', compact('maquilero'));
        return View::make('dashboard.maquileros.show')->with('maquileros', $this->maquilero);
	}

	/**
	 * Show the form for editing the specified maquilero.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
        return View::make('dashboard.maquileros.edit')->with('maquileros', $this->maquilero);
	}

	/**
	 * Update the specified maquilero in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{

		$validator = Validator::make($this->request->all(), Maquilero::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $this->maquilero->update($this->request->all(), $this->maquilero);

        return Redirect::route('maquileros.index')
                        ->with('msg', 'Datos guardados con exito.')
                        ->with('class', 'success');
	}

	/**
	 * Remove the specified maquilero from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$this->maquilero->destroy($id);

		return Redirect::route('maquileros.index')
                        ->with('msg', 'Registro eliminado.')
                        ->with('class', 'success');
	}

}
