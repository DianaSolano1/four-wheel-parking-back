<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * @api {GET} brand/vehicles
     *
     * @queryParam {String} name
     * @queryParam {Number} page
     */
    public function getVehiclesCount(Request $request)
    {
        $name = $request->query('name', '');

        $brandModel = Brand::withCount(['vehicles']);

        if ($name !== '') {
            $brandModel->where('name', 'like', '%' . $name . '%');
        }

        $brands = $brandModel->paginate();

        $brands->getCollection()->transform(function ($value) {
            $value->name = ucfirst(strtolower($value->name));

            return $value;
        });

        return ["success" => true, "data" => $brands];
    }
}
