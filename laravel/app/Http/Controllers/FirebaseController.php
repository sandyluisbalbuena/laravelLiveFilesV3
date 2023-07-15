<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;


class FirebaseController extends Controller
{
    private $database;

    public function __construct()
    {
        $this->database = Firebase::database();
        $this->threadtable = 'threads';
        $this->usertable = 'users';
    }

    public function getuserdata(){
        $reference = $this->database->getReference($this->tablename)->getValue();


        return response()->json($reference);
    }

    public function postthreaddata(Request $request){
            // return response()->$request;
        $postData = [
            'categoryId' => $request->categoryId,
			'title' => $request->title,
			'slug' => $request->slug,
			'content' => $request->content, 
			'userId' => $request->userId,
			'createdAt' => $request->createdAt,
			'updatedAt' => $request->updatedAt,
        ];

        $postRef = $this->database->getReference($this->threadtable)->push($postData);

        if($postRef){
            return response()->json('success');
        }else{
            return response()->json('fail');
        }
    }
}
