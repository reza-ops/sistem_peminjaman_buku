<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $route = 'user_management.role.';
    private $header = 'Role';
    private $sub_header = 'Role';
    private $title = 'Role';

    public function __construct()
    {

    }

    public function index(){
        $data = [
            'route'  => $this->route,
            'title'  => $this->title,
            'header' => $this->header,
        ];
        return view($this->route.'index', $data);
    }

    public function getData(Request $request) {
        return $this->mainRepo->getDataTable($request);
    }

}
