<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class AdministratorController extends Controller
{
    public function admin()
    {
        return view('admin.administrator.admin.index');
    }

    public function role()
    {
        return view('admin.administrator.role.index', ['detail' => false]);
    }

    public function roleDetail($id)
    {
        return view('admin.administrator.role.index', ['detail' => true, 'role' => Role::findOrFail($id)]);
    }
}
