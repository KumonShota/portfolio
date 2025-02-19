<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    public function show(Region $region)
    {
        $stores = $region->stores;
        return view('regions.show', compact('region', 'stores'));
    }
    public function index()
    {
        $regions = Region::all();
        return view('reviews.index', compact('regions'));
    }
}
