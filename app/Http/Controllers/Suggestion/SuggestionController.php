<?php

namespace App\Http\Controllers\Suggestion;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        try {
            $suggestions = User::query()
                ->whereNot('id', auth()->user()->id)
                ->paginate(10);

            $count = User::query()
                ->whereNot('id', auth()->user()->id)->count();

            $response = [
                'message' => 'Data retrieved successfully',
                'data' => $suggestions,
                'count' => $count
            ];
            if ($suggestions->isEmpty())
                return $this->response404("No suggestions found.");

            return response()->json($response);
//            return $this->sendResponse($suggestions, 'index', 'Suggestions', '', $count);
        }
        catch (\Exception $exception)
        {
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
