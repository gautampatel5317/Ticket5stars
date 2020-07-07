<?php

namespace App\Repositories\Backend\Pos;

use App\Models\Pos\Pos;
use App\Repositories\BaseRepository;

class PosRepository extends BaseRepository
{

    protected $model;

    public function __construct(Pos $model)
    {
        $this->model = $model;
    }
    /**
     * Associated Repository Model.
     */
    const MODEL = Pos::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->orderByDesc('id')->get();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \App\Repositories\Pos\PosRepositoryInterface::create()
     */
    public function create(array $input)
    {
        return Pos::create($input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $input, $id)
    {
        // dd($input);
        $record = $this->model->find($id);
        return $record->update($input);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pos)
    {
        return $pos->delete();
    }
    /**
     * For change Pos status
     */
    public function changeStatus($id, $status)
    {
        return $this->model->where('id', $id)
            ->update(['status' => $status]);
    }
    public function getById($id){
        return $this->model->findOrFail($id);
    }
}
