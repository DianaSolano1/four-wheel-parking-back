<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Owner;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * @api {GET} vehicle
     *
     * @param {String} plate
     */
    public function findByPlate($plate) {
        $vehicle = Vehicle::firstWhere('license_plate', $plate);

        if (empty($vehicle)) {
            return [];
        }

        return $vehicle;
    }

    /**
     * @api {POST} vehicle
     *
     * @header {String} Content-Type application/json
     * @header {String} Accept application/json
     *
     * @body {String} license_plate Max. 8
     * @body {String|Number} brand Send ID or name
     * @body {String|Number} type_vehicle Send ID or name
     * @body {Object} owner Send object with ID or documentId or name
     */
    public function create(Request $request) {
        $request->validate([
            'license_plate' => 'required|unique:vehicles|max:8',
            'brand' => 'required',
            'type_vehicle' => 'required',
            'owner' => 'required',
        ]);


        $license_plate = $request->license_plate;
        $brand = $request->brand;
        $type_vehicle = $request->type_vehicle;
        $owner = $request->owner;

        DB::beginTransaction();

        try {
            // ? Validate owner information
            if (empty($owner['id']) && (empty($owner['document_id']) || empty($owner['name']))) {
                throw new \Exception('Debes especificar el ID o los datos del propietario');
            }

            if (!empty($owner['id'])){
                $dataOwner = Owner::find($owner['id']);
            } else {
                $dataOwner = Owner::firstOrCreate(
                    ['document_id' => $owner['document_id']],
                    ['name' => $owner['name']]
                );
            }

            if (empty($dataOwner)) {
                throw new \Exception('Falló al reconocer al propietario');
            }


            // ? Validate brand information
            if (is_int($brand)) {
                $dataBrand = Brand::find($brand);
            } else {
                $dataBrand = Brand::firstOrCreate(['name' => $brand]);
            }

            if (empty($dataBrand)) {
                throw new \Exception('Falló al reconocer la marca');
            }


            // ? Validate type vehicle information
            if (is_int($type_vehicle)) {
                $dataTypeVehicle = TypeVehicle::find($type_vehicle);
            } else {
                $dataTypeVehicle = TypeVehicle::firstOrCreate(['name' => $type_vehicle]);
            }

            if (empty($dataTypeVehicle)) {
                throw new \Exception('Falló al reconocer el tipo de vehículo');
            }


            // * Create vehicle
            Vehicle::firstOrCreate(
                ['license_plate' => $license_plate],
                [
                    'owner_id' => $dataOwner->id,
                    'brand_id' => $dataBrand->id,
                    'type_vehicle_id' => $dataTypeVehicle->id,
                ]
            );

            DB::commit();

            return ['success' => true, 'message' => 'Vehículo creado correctamente'];
        } catch (\Exception $th) {
            DB::rollBack();

            if (!($message = $th->getMessage())) {
                $message = 'Falló al crear el vehículo';
            }

            return ['message' => $message];
        }
    }
}
