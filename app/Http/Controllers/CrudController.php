<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{
    //

    public function store(Request $request){
        // return ["message"=>"Category has been added"];
        $validate_rules = [
            'name' => 'required | min: 2',
        ];
        $this->validate($request, $validate_rules);
        // return $request->all();

        return $request->all();
    }
}
