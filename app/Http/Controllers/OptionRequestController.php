<?php

namespace App\Http\Controllers;

use App\Models\OptionRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class OptionRequestController extends Controller
{
    /** Show the "Request More Options" quote form for a product. */
    public function create(Product $product)
    {
        return view('product-request', compact('product'));
    }

    /** Store a submitted request and return to the form with a success notice. */
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:5000'],
            'consent' => ['accepted'],
        ], [
            'consent.accepted' => 'Please agree to be contacted before sending.',
        ]);

        unset($data['consent']);
        $data['product_id'] = $product->id;
        $data['product_name'] = $product->name;

        OptionRequest::create($data);

        return redirect()->route('product.request', $product)
            ->with('success', 'Thank you! Your request has been submitted. We will get back to you soon.');
    }
}
