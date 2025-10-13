<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Http\Requests\Admin\StoreDiscountRequest;
use App\Http\Requests\Admin\UpdateDiscountRequest;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of discounts.
     */
    public function index()
    {
        $discounts = Discount::withCount('tours')->latest()->paginate(15);
        
        return view('admin.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new discount.
     */
    public function create()
    {
        return view('admin.discounts.create');
    }

    /**
     * Store a newly created discount in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        Discount::create($request->validated());

        return redirect()
            ->route('admin.discounts.index')
            ->with('success', 'Discount created successfully!');
    }

    /**
     * Display the specified discount.
     */
    public function show(Discount $discount)
    {
        $discount->load('tours');
        return view('admin.discounts.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified discount.
     */
    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified discount in storage.
     */
    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $discount->update($request->validated());

        return redirect()
            ->route('admin.discounts.index')
            ->with('success', 'Discount updated successfully!');
    }

    /**
     * Remove the specified discount from storage.
     */
    public function destroy(Discount $discount)
    {
        // Check if discount is being used by any tours
        if ($discount->tours()->count() > 0) {
            return redirect()
                ->route('admin.discounts.index')
                ->with('error', 'Cannot delete discount that is being used by tours!');
        }

        $discount->delete();

        return redirect()
            ->route('admin.discounts.index')
            ->with('success', 'Discount deleted successfully!');
    }
}
