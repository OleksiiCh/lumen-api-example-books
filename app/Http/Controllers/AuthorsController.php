<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;

class AuthorsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function showAllAuthors(Request $request) {

        $allAuthors = Authors::select('id', 'name');
        if ($request->has('limit'))
            $allAuthors->take($request->limit);
        if ($request->has('offset'))
            $allAuthors->skip($request->offset);
        $authors = [
            'authors' => $allAuthors->get(),
            'limit' => ($request->has('limit') ? $request->limit : ''),
            'offset' => ($request->has('offset') ? $request->offset : ''),
            'rows' => Authors::get()->count(),
        ];
        if (count($authors['authors']) == 0) {
            $status = 'NOT_FOUND';
            $message = 'Please provide others parameters.';
        } else {
            $status = 'ok';
            $message = 'ok';
        }
        return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' => $authors
                        ], 200);
    }

    public function showOneAuthor($id) {
        return response()->json(Authors::select('id', 'name')->find($id));
    }

}