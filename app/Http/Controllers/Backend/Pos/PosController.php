<?php

namespace App\Http\Controllers\Backend\Pos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Pos\CreatePosRequest;
use App\Http\Requests\Backend\Pos\StorePosRequest;
use App\Http\Requests\Backend\Pos\UpdatePosRequest;
use App\Models\Pos\Pos;
use App\Repositories\Backend\Pos\PosRepository;
use Illuminate\Http\Request;

class PosController extends Controller
{

    protected $model;
    public function __construct(PosRepository $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('pos_access'), 403);
        return view('backend.pos.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreatePosRequest $request)
    {
        abort_unless(\Gate::allows('pos_create'), 403);
        return view('backend.pos.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePosRequest $request)
    {
        abort_unless(\Gate::allows('pos_create'), 403);
        $input = $request->except('_token');
        $this->model->create($input);
        flash(trans('alerts.pos_add_message'))->success()->important();
        return redirect()->route('admin.pos.index');
    }
    public function show(Pos $pos)
    {
        abort_unless(\Gate::allows('pos_show'), 403);
        return view('backend.pos.show', compact('pos'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pos = $this->model->getById($id);
        abort_unless(\Gate::allows('pos_edit'), 403);
        return view('backend.pos.edit', compact('pos'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePosRequest $request, $id)
    {
        abort_unless(\Gate::allows('pos_edit'), 403);
        $input   = $request->except('_token');
        $this->model->update($input, $id);
        flash(trans('alerts.pos_edit_message'))->success()->important();
        return redirect()->route('admin.pos.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pos $pos)
    {
        abort_unless(\Gate::allows('pos_delete'), 403);
        $this->model->destroy($pos);
        return "success";
    }

    public function changeStatus(Request $request)
    {
        $input = $request->except('_token');
        $flag = $this->model->changeStatus($input['id'], $input['status']);
        if ($flag == 1) {
            return "success";
        } else {
            return "failed";
        }
    }
}
