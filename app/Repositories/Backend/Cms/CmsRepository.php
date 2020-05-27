<?php
namespace App\Repositories\Backend\Cms;

use App\Repositories\BaseRepository;
use App\Models\Cms\Cms;

class CmsRepository extends BaseRepository
{

    protected $model;

    public function __construct(Cms $model)
    {
        $this->model = $model;
    }
    const MODEL = Cms::class;
    /**
     * Get Cms data
     */
    public function getForDataTable($status)
    {
        if ($status != "" && ($status == "0" || $status == "1")) {
            return $this->model->where('status', '=', $status)->orderByDesc('id')->get();
        } else {
            return $this->model->orderByDesc('id')->get();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $input)
    {
        return Cms::create($input);
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
        $record = $this->model->find($id);
        return $record->update($input);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->find($id);
        return $record->delete();
    }
}
?>