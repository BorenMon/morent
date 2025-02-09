<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutingController extends Controller
{

    public function __construct()
    {
        // $this->
        // middleware('auth')->
        // except('index');
    }

    /**
     * second level route
     */
    public function secondLevel(Request $request, $first, $second)
    {

        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first == "assets")
            return redirect('admin.dashboard');

        return view('admin.demo.' . $first . '.' . $second, ['mode' => $mode, 'demo' => $demo]);
    }

    /**
     * third level route
     */
    public function thirdLevel(Request $request, $first, $second, $third)
    {
        $mode = $request->query('mode');
        $demo = $request->query('demo');

        if ($first == "assets")
            return redirect('admin.dashboard');

        dd($first, $second, $third);

        return view('admin.demo.' . $first . '.' . $second . '.' . $third, ['mode' => $mode, 'demo' => $demo]);
    }
}
