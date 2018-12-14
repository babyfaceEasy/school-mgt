<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function open()
    {
        $data = "This data is opened, and can be accessed without the client.";
        return response()->json(compact('data'), 200);
    }

    public function closed()
    {
        $data = "Only authorized users an see this.";
        return response()->json(compact('data'), 200);
    }
}
