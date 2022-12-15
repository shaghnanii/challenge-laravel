<?php

namespace App\Http\Controllers\Connection;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ConnectionInCommonController extends Controller
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


            return $this->sendResponse($connections, 'index', 'Common Connections');
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
        //
    }
}
