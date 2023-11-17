<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function store(StatusRequest $request)
    {
        $request->make();
        return redirect()->back();
    }
}
