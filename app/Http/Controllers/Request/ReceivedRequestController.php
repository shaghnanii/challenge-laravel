<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request\ReceivedRequestStoreRequest;
use App\Models\Connection;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ReceivedRequestController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $requests = Connection::query()
                ->with('user')
                ->where('with_user', auth()->user()->id)
                ->where('status', 'pending')
                ->paginate(10);

            $count = Connection::query()
                ->with('user')
                ->where('with_user', auth()->user()->id)
                ->where('status', 'pending')
                ->count();

            $response = [
                'message' => 'Data retrieved successfully',
                'data' => $requests,
                'count' => $count
            ];

            if ($requests->isEmpty())
                return $this->response404("No received requests found.");

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

    public function store(ReceivedRequestStoreRequest $request)
    {
        try {
//            TODO:: checking the with and auth user id
            $connection = Connection::query()
                ->where('status', 'pending')
                ->find($request->connection_id);
            if (!$connection)
                return $this->response404("No such connection found with the provided id.");

            $connection->update(
                [
                    'status' => 'connected'
                ]
            );

            return $this->sendResponse($connection, 'store', "Request");
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
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
        //
    }
}
