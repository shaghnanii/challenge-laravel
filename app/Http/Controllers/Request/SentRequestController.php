<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\SentRequestIndexRequest;
use App\Models\Connection;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SentRequestController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $requests = Connection::query()
                ->with('connectedWith')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'pending')
                ->paginate(10);

            $count = Connection::query()
                ->with('connectedWith')
                ->where('user_id', auth()->user()->id)
                ->where('status', 'pending')
                ->count();

            $response = [
                'message' => 'Data retrieved successfully',
                'data' => $requests,
                'count' => $count
            ];

            if ($requests->isEmpty())
                return $this->response404("No sent requests found.");

            return response()->json($response);
//            return $this->sendResponse($requests, 'index', 'Requests');
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $sentRequest = Connection::query()
                ->where('user_id', auth()->user()->id)
                ->where('status', 'pending')
                ->find($id);

            if (!$sentRequest)
                return $this->response404("No such request found with the provided id.");
            $sentRequest->delete();

            return $this->sendResponse($sentRequest, 'destroy', 'Requests');
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }
}
