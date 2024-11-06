<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Module;
use App\Models\Role;
use App\Models\User;
use App\Supports\LogHistorySupport;
use App\Supports\ResponseValidation;
use App\Validations\RoleValidation;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = [
      "roles" => Role::query()->where("id", "!=", 1)->orderBy("role_name")->get()
    ];

    return $this->view_admin("admin.roles.index", "Role Management", $data);
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
  public function store(RoleRequest $request)
  {
    $role = Role::create($request->only("role_name"));

    LogHistorySupport::store("Store Role", new_data: $role->toArray());

    $response = response_success_default("Berhasil membuat role!", $role->id, route("app.roles.show", $role->id));

    return response_json($response);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role)
  {
    $data = [
      "role" => $role,
      "users" => User::query()->where("role_id", $role->id)->get(),
      "user_other" => User::query()->with("role")->where("role_id", "!=", $role->id)->where("id", "!=", 1)->get()
    ];

    return $this->view_admin("admin.roles.show", "Detail Role", $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(RoleRequest $request, Role $role)
  {
    $values = [
      "role_name" => $request->role_name
    ];

    Role::query()
    ->where("id", $role->id)
    ->update($values);

    LogHistorySupport::store("Store Role", $role->toArray(), $values);

    $response = response_success_default("Berhasil memperbarui role!", $role->id, route("app.roles.show", $role->id));

    return response_json($response);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  /**
   * Assign user
   *
   * @param Request $request
   * @param Role $role
   */
  public function assign_user(Request $request, Role $role)
  {
    User::query()->whereIn("id", $request->only("user_id"))->update([
      "role_id" => $role->id
    ]);

    LogHistorySupport::store("Assign User To Role", new_data: $request->only("user_id"));

    $response = response_success_default("Berhasil assign user!", $role->id, route("app.roles.show", $role->id));
    return response_json($response);
  }
}
