<?php

namespace App\Repositories\Backend\Subscription;

use App\Repositories\BaseRepository;
use App\Models\Subscription\Subscription;
use Illuminate\Support\Facades\DB;

class SubscriptionRepository extends BaseRepository
{

    protected $model;

    public function __construct(Subscription $model)
    {
        $this->model = $model;
    }
    /**
     * Associated Repository Model.
     */
    const MODEL = Subscription::class;

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->model->orderByDesc('id')->get();
    }

    public function getSubscription()
    {
        return $this->model->where('status', '1')->orderByDesc('id')->get();
    }
    /**
     *
     * {@inheritDoc}
     *
     * @see \App\Repositories\Subscription\SubscriptionRepositoryInterface::create()
     */
    public function create(array $input)
    {
        $input['created_by'] = auth()->user()->id;
        return Subscription::create($input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $input, $subscription)
    {
        $input['updated_by'] = auth()->user()->id;
        return $subscription->update($input);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subscription)
    {
        return $subscription->delete();
    }
    /**
     * For change country status
     */
    public function changeStatus($id, $status)
    {
        return $this->model->where('id', $id)
        ->update(['status' => $status, 'updated_by' => auth()->user()->id]);
    }
}
