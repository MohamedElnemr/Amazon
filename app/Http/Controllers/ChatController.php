<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatFile;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //


    public function index(Request $request)
    {

    }

    public function sendMessage(Request $request)
    {
        $data = $request->only('reciver_id', 'message');
        $data['sender_id'] = auth()->user()->id;
        $chat = Chat::create($data);


        if ($request->file('file')) {
            $file = $request->file('file');
            $path = 'uploads';
            $file_name =  now()->format('Y-m-dH-i') . '.' . $file->extension();
            $file->move($path, $file_name);

            $full_path = $path . '/' . $file_name;
            ChatFile::create([
                'chat_id' => $chat->id,
                'path' => $full_path
            ]);
            $chat->file_path = \URL::to('/') . '/' . $full_path;
        }

    }


}
