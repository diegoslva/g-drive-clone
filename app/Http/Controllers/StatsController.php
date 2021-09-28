<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StatsController extends Controller
{
    //

    public function stats()
    {
      abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
      $stats = DB::table('users')
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();
        
      return response()->json($stats);
    }
}
