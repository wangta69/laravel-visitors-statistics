<?php

namespace Pondol\VisitorsStatistics\Http\Controllers\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pondol\Common\Facades\JsonKeyValue;

use App\Http\Controllers\Controller;

class ConfigController extends Controller
{

  public function edit(Request $request) {

    $config = JsonKeyValue::getAsJson('visitor');
    $config->name = "aaa";
    return view('visitors::admin.edit', compact('config'));
  }

}
