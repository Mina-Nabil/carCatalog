<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\Customer;
use App\Models\Partner;
use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    function home()
    {
        $data = self::getDefaultSiteInfo(true, "Home");
        $data['brands'] = Brand::where('BRND_ACTV', 1)->get();
        $data['types'] = CarType::with(['cars', 'cars.model'])->get();
        $data['years'] = CarModel::getModelYears();
        $data['mainModels']  =   CarModel::with(["brand"])->join('brands', 'MODL_BRND_ID', '=', 'brands.id')->where('BRND_ACTV', 1)
            ->where('MODL_ACTV', 1)->where('MODL_MAIN', 1)->orderByDesc('models.id')->limit(2)->get();
        $mainModelsCount = count($data['mainModels']);
        if ($mainModelsCount == 0) {
            $data['mainModels']  =  CarModel::with(["brand"])->join('brands', 'MODL_BRND_ID', '=', 'brands.id')->where('BRND_ACTV', 1)->orderByDesc('models.id')->limit(2)->get();
        } elseif ($mainModelsCount == 1) {
            $data['mainModels']->push(CarModel::with(["brand"])->join('brands', 'MODL_BRND_ID', '=', 'brands.id')->where('BRND_ACTV', 1)
                ->where('MODL_ACTV', 1)->where('MODL_MAIN', 0)->orderByDesc('models.id')->first());
        }
        if (isset($data['frontendData']['Offers']) && $data['frontendData']['Offers']['Active']) {
            $data['offers'] = Car::join('models', 'CAR_MODL_ID', '=', 'cars.id')
                ->join('brands', 'MODL_BRND_ID', '=', 'brands.id')
                ->where('CAR_OFFR', 1)->where('CAR_ACTV', 1)
                ->where('BRND_ACTV', 1)->where('MODL_ACTV', 1)
                ->get();
        }
        if ($data['frontendData']['Trending cars']['Active']) {
            $data['trends'] = Car::join('models', 'CAR_MODL_ID', '=', 'cars.id')
                ->join('brands', 'MODL_BRND_ID', '=', 'brands.id')
                ->where('CAR_TRND', 1)->where('CAR_ACTV', 1)
                ->where('BRND_ACTV', 1)->where('MODL_ACTV', 1)
                ->get();
        }
        if (isset($data['frontendData']['Customers']) && $data['frontendData']['Customers']['Active']) {
            $data['customers'] = Customer::all();
        }
        return view('frontend.home', $data);
    }

    public static function getDefaultSiteInfo(bool $carouselHeader, string $pageTitle, string $headerImage=null)
    {
        //make sure everychange here should be reflected on 404 page
        $data['carouselHeader'] = $carouselHeader;
        $data['headerImage'] = $headerImage;
        $data['pageTitle'] = $pageTitle;
        $data['topCars']  =   Car::with(["model", "model.brand"])->orderByDesc('CAR_VLUE')->limit(5)->get();

        $data['aboutUs']  =   AboutUs::getAboutUs();
        $data['frontendData'] =   SiteInfo::getSiteInfo();
        $data['partners'] =   Partner::all();
        $data['models']   =   CarModel::with(["brand"])->join("brands", "MODL_BRND_ID", '=', 'brands.id')
            ->where('MODL_ACTV', 1)->where('BRND_ACTV', 1)->get();

        return $data;
    }
}
