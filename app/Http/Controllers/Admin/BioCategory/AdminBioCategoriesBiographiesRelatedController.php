<?php

namespace App\Http\Controllers\Admin\BioCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Biography\AdminBiographyCollection;
use App\Models\BioCategory;
use Illuminate\Http\Request;

/**
 * Class AdminBioCategoriesBiographiesRelatedController
 * @package App\Http\Controllers\Admin\BioCategory
 */
class AdminBioCategoriesBiographiesRelatedController extends Controller
{
    /**
     * @param BioCategory $bioCategory
     * @return AdminBiographyCollection
     */
    public function index(BioCategory $biocategory)
    {
        return new AdminBiographyCollection($biocategory->biographies);
    }
}
