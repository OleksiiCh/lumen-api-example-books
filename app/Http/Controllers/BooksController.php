<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function showAllBooks(Request $request) {
        $books = Books::select('id', 'title', 'author as author_id');
        if ($request->has('limit'))
            $books->take($request->limit);
        if ($request->has('offset'))
            $books->offset($request->offset);
        $books->with('Author:id,name');
        $books = [
            'books' => $books->get(),
            'limit' => ($request->has('limit') ? $request->limit : ''),
            'offset' => ($request->has('offset') ? $request->offset : ''),
            'rows' =>  Books::get()->count(),
        ];
        if (count($books['books']) == 0) {
            return response()->json(['status'=>'NOT_FOUND','message'=>'Please provide others parameters.'],404);
        } else {
            $status = 'ok';
            $message = 'ok';
        }        
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $books
        ],200);
    }
    
    public function showBooksOfOneAuthor($id, Request $request) {        
        $books = Books::select('id', 'title', 'author as author_id');
        $books->where('author', '=', $id);
        if ($request->has('limit'))
            $books->take($request->limit);
        if ($request->has('offset'))
            $books->offset($request->offset);
        $books->with('Author:id,name');
        $books = [
            'books' => $books->get(),
            'limit' => ($request->has('limit') ? $request->limit : ''),
            'offset' => ($request->has('offset') ? $request->offset : ''),
            'rows' =>  Books::get()->where('author', '=', $id)->count(),
        ];
        if (count($books['books']) == 0) {
            return response()->json(['status'=>'NOT_FOUND','message'=>'Please provide others parameters.'],404);
        } else {
            $status = 'ok';
            $message = 'ok';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $books
        ],200);      
    }    

}