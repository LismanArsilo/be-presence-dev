<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function getAllNote()
    {
        try {
            $notes = Note::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

            $data = [
                'data' => $notes
            ];

            return response()->json(['status' => true, 'message' => 'Get All Note Successfully', 'data' => $data], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOneNote(Request $request, $id)
    {
        try {
            $note = Note::where('id', $id)->where('user_id', Auth::user()->id)->first();

            if (!$note) {
                return response()->json(['status' => false, 'message' => 'Note Not Found'], Response::HTTP_NOT_FOUND);
            }

            $data = [
                'data' => $note
            ];

            return response()->json(['status' => true, 'message' => 'Get One Note Successfully', 'data' => $data], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createNote(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()], Response::HTTP_BAD_REQUEST);
            }

            $validated = $validate->validated();

            $data = [
                'user_id' => Auth::user()->id,
                'title' => $validated['title'],
                'content' => $validated['content'],
            ];

            $note = Note::create($data);

            return response()->json(['status' => true, 'message' => 'Create Note Successfully', 'data' => $note], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateNote(Request $request, $id)
    {
        try {
            $note = Note::where('id', $id)->where('user_id', Auth::user()->id)->first();

            if (!$note) {
                return response()->json(['status' => false, 'message' => 'Note Not Found'], Response::HTTP_NOT_FOUND);
            }

            $validate = Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required',
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()], Response::HTTP_BAD_REQUEST);
            }

            $validated = $validate->validated();

            $data = [
                'title' => $validated['title'],
                'content' => $validated['content'],
            ];

            $note->title = $validated['title'];
            $note->content = $validated['content'];
            $note->save();

            return response()->json(['status' => true, 'message' => 'Update Note Successfully', 'data' => $note], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteNote(Request $request, $id)
    {
        try {
            $note = Note::where('id', $id)->first();

            if (!$note) {
                return response()->json(['status' => false, 'message' => 'Note Not Found'], Response::HTTP_NOT_FOUND);
            }

            $note->delete();

            return response()->json(['status' => true, 'message' => 'Delete Note Successfully'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
