<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalPackage;
use Illuminate\Http\Request;

class RentalPackageController extends Controller
{
    public function index()
    {
        $packages = RentalPackage::orderBy('sort_order')->paginate(20);
        return view('admin.rental-packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.rental-packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'hours' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        RentalPackage::create($data);

        return redirect()->route('admin.rental-packages.index')->with('success', 'Package created.');
    }

    public function edit(RentalPackage $rentalPackage)
    {
        return view('admin.rental-packages.edit', compact('rentalPackage'));
    }

    public function update(Request $request, RentalPackage $rentalPackage)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'hours' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $rentalPackage->update($data);

        return redirect()->route('admin.rental-packages.index')->with('success', 'Package updated.');
    }

    public function destroy(RentalPackage $rentalPackage)
    {
        $rentalPackage->delete();
        return redirect()->route('admin.rental-packages.index')->with('success', 'Package deleted.');
    }
}
