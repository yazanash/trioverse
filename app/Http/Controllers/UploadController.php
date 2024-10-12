<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;


class UploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadLargeFile(Request $request)
    {
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        if ($receiver->isUploaded() === false) {
            return response()->json(['error' => 'File not uploaded'], 400);
        }

        $save = $receiver->receive();

        if ($save->isFinished()) {
            $file = $save->getFile();
            $path = $file->storeAs('uploads', $file->getClientOriginalName());

            return response()->json(['path' => $path], 200);
        }

        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }
}
