<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;


class GuestbookController extends Controller
{
    
    public function store (Request $request ){
          // TODO 2: ROUTING
          if ($request->isMethod('post')) {
            // TODO 3: CODE by REQUEST METHODS (ACTIONS) GET, POST, etc. (handle data from request): 1) validate 2) working with data source 3.raw) transforming data
            // 1. Create empty $infoMessage
            $infoMessage = '';

            // // 2. handle form data
            // $validatedData = $request->validate([
            //     'email' => 'required|email',
            //     'name' => 'required',
            //     'text' => 'required',
            // ]);

            // 3. Prepare data
            $aComment = $request->post();
            $aComment['date'] = date('Y-m-d H:i:s');
            // dd($aComment);

            // create new comment
            // try {
                DB::table('comments')->insert([
                    'email' => $aComment['email'],
                    'name' => $aComment['name'],
                    'text' => $aComment['text'],
                    'date' => $aComment['date']
                ]);
            // } catch (QueryException $e) {
                // handle exception here, for example log the error
            //     // Log::error($e->getMessage());
            //     $infoMessage = 'An error occurred while adding the comment. Please try again later.';
            // }
            $arguments = [
                'infoMessage' => $infoMessage,
                // 'aConfig' => $aConfig
            ];
            
        }
        return redirect()->route('guestbook.execute');
    }
    public function execute(Request $request)
    { 
        // TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
        // No need to manually start session, Laravel handles it automatically

        $comments=DB::table('comments')->where([['id','>',0]])->get();

   
            $arguments = [
                'infoMessage' => '',
                'comments' => $comments
           ];
       

        return view('guestbook', $arguments);
    }
}

