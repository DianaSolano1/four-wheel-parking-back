<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * @api {GET} brand/vehicles
     */
    public function getVehiclesCount() {

        $brands = Brand::withCount(['vehicles'])->paginate();

        if (empty($brands)) {
            return [];
        }

        return $brands;
    }
}
