<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class CaesarCipher extends BaseController
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
            return view("caesarCipher");
    }

    public function compute(Request $request){
        $data = [];
        return View::make('caesarCipher')->with('data',$data);
    }
}
