<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\CreateUserRequest;
use App\Http\Requests\Backend\User\ManageUserRequest;
use App\Http\Requests\Backend\User\MassDestroyUserRequest;
use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Models\Role\Role;
use App\Models\User\User;
use App\Repositories\Backend\User\UserRepository;

class UsersController extends Controller {
	/**
	 * @var UserRepository
	 */
	protected $user;
	/**
	 * @param \App\Repositories\Backend\Blogs\UserRepository $user
	 */
	public function __construct(UserRepository $user) {
		$this->user = $user;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(ManageUserRequest $request) {
		abort_unless(\Gate::allows('user_access'), 403);
		$users = $this->user->getForDataTable();
		return view('backend.users.index', compact('users'));
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(CreateUserRequest $request) {
		abort_unless(\Gate::allows('user_create'), 403);
		$roles = Role::all()->pluck('title', 'id');
		return view('backend.users.create', compact('roles'));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreUserRequest $request) {
		abort_unless(\Gate::allows('user_create'), 403);
		$input = $request->except('_token');
		$user  = $this->user->create($input);
		return redirect()->route('admin.users.index');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user) {
		abort_unless(\Gate::allows('user_edit'), 403);
		$roles = Role::all()->pluck('title', 'id');
		$user->load('roles');
		return view('backend.users.edit', compact('roles', 'user'));
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateUserRequest $request, User $user) {
		abort_unless(\Gate::allows('user_edit'), 403);
		$input = $request->except('_token');
		$user  = $this->user->update($input, $user);
		return redirect()->route('admin.users.index');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		abort_unless(\Gate::allows('user_show'), 403);
		$user = $this->user->show($user);
		return view('backend.users.show', compact('user'));
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user) {
		abort_unless(\Gate::allows('user_delete'), 403);
		$user = $this->user->destroy($user);
		return back();
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function massDestroy(MassDestroyUserRequest $request) {
		$this->user->massDestroy(request('ids'));
		return response(null, 204);
	}
}
