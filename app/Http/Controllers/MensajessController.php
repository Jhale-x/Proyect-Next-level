<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajessController extends Controller
{
    public function create($curso)
    {
        return view('mensajess', compact('curso'));
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 6449e0ffd2cda145b29f11a55a06e18829329855
