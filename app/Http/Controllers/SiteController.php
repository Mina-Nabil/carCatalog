<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\Partner;
use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    private $data;

    function __construct()
    {
        //make sure everychange here should be reflected on 404 page
        $this->data['aboutUs']  =   AboutUs::getAboutUs();
        $this->data['siteData'] =   SiteInfo::getSiteInfo();
        $this->data['partners'] =   Partner::all();
        $this->data['topCars']  =   Car::with(["model", "model.brand"])->orderByDesc('CAR_VLUE')->limit(5)->get();
        $this->data['models']   =   CarModel::with(["brand"])->join("brands", "MODL_BRND_ID", '=', 'brands.id')
                                    ->where('MODL_ACTV',1)->where('BRND_ACTV', 1)->get();
        $this->data['brands'] = Brand::where('BRND_ACTV', 1)->get();
        $this->data['types'] = CarType::with(['cars', 'cars.model'])->get();
        $this->data['years'] = CarModel::getModelYears();
    }

    function home(){
        $this->loadSiteInfo(true, "Home");


        return view('site.home', $this->data);
    }

    private function loadSiteInfo(bool $carouselHeader, string $pageTitle){
        $this->data['carouselHeader'] = $carouselHeader;
        $this->data['pageTitle'] = $pageTitle;
    }
}
