<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use Repostory\Contaract\IncomeContract;
use Yajra\DataTables\Facades\DataTables;

class IncomeController extends Controller
{

    protected $income;

    /**
     * Depedency Injection Repo
     */
    public function __construct(IncomeContract $income)
    {
        $this->income = $income;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('income.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncomeRequest $request)
    {

        $imagePath = $request->file('images');

        $imageName = $imagePath->getClientOriginalName();

        $request->file('images')->storeAs('uploads', $imageName, 'public');

        $data = array_merge($request->validationData(), [
            'images' => $imageName,
        ]);

        if ($request->validated()) {
            $this->income->store($data);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    /**
     * For Consuming AJAX
     */
    public function getIncome()
    {
        return DataTables::of($this->income->all())
            ->addColumn('Actions', function ($data) {
                return '<button class="btn btn-secondary trigger--fire-modal-2 trigger--fire-modal-2" type="button" id="toggle-edit" data-id="' . $data->id . '">Edit</button>
                    <button type="button" data-id="' . $data->id . '" data-toggle="modal" data-target="#DeleteArticleModal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->addColumn('Images', function ($data) {
                return '<img src="' . asset('storage/uploads/' .  $data->images)   . '" alt="" height="80" width="80">';
            })
            ->rawColumns(['Actions', 'Images'])
            ->make(true);
    }
}
