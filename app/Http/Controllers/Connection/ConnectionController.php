<?php

namespace App\Http\Controllers\Connection;

use App\Http\Controllers\Controller;
use App\Http\Requests\Connection\ConnectionStoreRequest;
use App\Models\Connection;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $connections = Connection::query()
                ->with('connectedWith')
                ->where('status', 'connected')
                ->where('user_id', auth()->user()->id)
                ->paginate(10);

            foreach ($connections as $connection) {
                $connection->common = Connection::query()->with('connectedWith')->where('user_id', $connection->connectedWith->id)->get();
            }

            $count = Connection::query()
                ->with('connectedWith')
                ->where('status', 'connected')
                ->where('user_id', auth()->user()->id)
                ->count();

            $response = [
                'message' => 'Data retrieved successfully',
                'data' => $connections,
                'count' => $count
            ];

            if ($connections->isEmpty())
                return $this->response404("No connections found.");

            return response()->json($response);
//            return $this->sendResponse($connections, 'index', Connection::class);
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }

    public function create()
    {
        //
    }

    public function store(ConnectionStoreRequest $request)
    {
        try {
            $user = User::query()->find(auth()->user()->id);
            if (!$user)
                return $this->response404("No authenticated user found.");

            if ($request->with_user == auth()->user()->id)
                return $this->response409("You cannot send connection request to yourself.");

            $otherUser = User::query()->find($request->with_user);
            if (!$otherUser)
                return $this->response404("No user found to connect with.");
            $checkingConnection = $user->connections->where('with_user', $request->with_user)->first();
            if ($checkingConnection && $checkingConnection->status === 'pending')
                return $this->response409("You have already sent a connection request to the user.");

            if ($checkingConnection && $checkingConnection->status === 'connected')
                return $this->response409("You are already connected with the user.");

            $result = $user->connections()->create($request->only((new Connection)->getFillable()));

            return $this->sendResponse($result, 'store', Connection::class);
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
        try {
            $connection = Connection::query()
                ->where('status', 'connected')
                ->find($id);

            if (!$connection)
                return $this->response404("No such connection found with the provided id.");

            $connection->delete();

            return $this->sendResponse($connection, 'destroy', 'Connection');
        }
        catch (\Exception $exception) {
            return $this->response500($exception->getMessage());
        }
    }
}
