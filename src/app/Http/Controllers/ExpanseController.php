<?php

namespace App\Http\Controllers;

use App\Models\Expanse;
use Illuminate\Http\Request;
use Repostory\Contaract\ExpanseContract;
use Yajra\DataTables\DataTables;

class ExpanseController extends Controller
{

    protected $repo;

    public function __construct(ExpanseContract $repo)
    {
        $this->repo = $repo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expanse.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function show(Expanse $expanse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function edit(Expanse $expanse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expanse $expanse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expanse  $expanse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expanse $expanse)
    {
        //
    }

    public function getExpanseData()
    {

        return DataTables::of($this->repo->all())
            ->addColumn('action', function ($expanse) {
                return '<button type="button" data-id="' . $expanse->id . '" data-target="#modal-expanse"  class="btn btn-info btn-sm edit" id="getEditId">edit</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
