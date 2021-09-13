<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * @api {GET} owner
     *
     * @param {String} documentId
     */
    public function findByDocument($documentId) {
        $owner = Owner::firstWhere('document_id', $documentId);

        if (empty($owner)) {
            return [];
        }

        return $owner;
    }
}
