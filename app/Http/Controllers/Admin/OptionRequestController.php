<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionRequest;

class OptionRequestController extends Controller
{
    public function index()
    {
        $requests = OptionRequest::with('product')->latest()->paginate(20);

        return view('admin.requests.index', compact('requests'));
    }

    public function destroy(OptionRequest $optionRequest)
    {
        $optionRequest->delete();

        return back()->with('success', 'Request deleted successfully.');
    }
}
