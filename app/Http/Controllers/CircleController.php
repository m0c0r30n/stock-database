<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

use App\Lib\Univ;
use App\Lib\Category;
use App\Lib\Area;
use App\Circle;

class CircleController extends Controller
{
  /**
     * クライアントの使用端末がMobileかPCか判定
     *
     * @param $request
     * @return string
     * @access private
     */

    public function index(Request $request) {
        return view('circle.index');
    }

}
