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

    function model($id)
    {
        $model = CarModel::with('cars', 'type', 'brand')->findOrFail($id);
        $data = self::getDefaultSiteInfo(false, $model->MODL_NAME, null, $model->brand->BRND_NAME . ' ' . $model->MODL_NAME . ' ' . $model->MODL_YEAR . '\'s Categories');
        $data['carList'] = $model->cars;

        return view('frontend.list', $data);
    }

    function car($id)
    {
        $car = Car::with('model', 'model.brand', 'model.type')->findOrFail($id);
        $data = self::getDefaultSiteInfo(false, $car->model->MODL_NAME . ' ' . $car->CAR_CATG, null, null, false);
        $data['similar'] = Car::with('model', 'model.brand')->where("CAR_MODL_ID", $id)->where("cars.id", "!=", $id)->get();
        $data['car'] = $car;
        $data['carAccessories'] = $car->getFullAccessoriesArray();
        return view('frontend.car', $data);
    }

    function compare()
    {
    }

    function calculator()
    {
    }

    function aboutus()
    {
    }

    function search(Request $request)
    {
        $data = self::getDefaultSiteInfo(false, "Find Your Car", null, "Find your search results below", true);
        $prices = explode(',', $request->price);
        $data['carList'] = self::getSearchResults($request->typeID, $request->brandID, $request->modelID, $request->year, $prices[0]??$data['carsMin'], $prices[1]??$data['carsMax']);
        return view('frontend.list', $data);
    }

    public static function getDefaultSiteInfo(bool $carouselHeader, string $pageTitle, string $headerImage = null, string $pageSubtitle = null, $isHeader=true)
    {
        //make sure everychange here should be reflected on 404 page
        $data['carouselHeader'] = $carouselHeader;
        $data['headerImage'] = $headerImage;
        $data['pageSubtitle'] = $pageSubtitle;
        $data['pageTitle'] = $pageTitle;
        $data['isHeader'] = $isHeader;
        $data['topCars']  =   Car::with(["model", "model.brand"])->orderByDesc('CAR_VLUE')->limit(5)->get();

        $data['aboutUs']  =   AboutUs::getAboutUs();
        $data['frontendData'] =   SiteInfo::getSiteInfo();
        $data['partners'] =   Partner::all();


        //Search Form
        $data['models']   =   CarModel::with(["brand"])->join("brands", "MODL_BRND_ID", '=', 'brands.id')
            ->where('MODL_ACTV', 1)->where('BRND_ACTV', 1)->select('models.*', "brands.BRND_NAME")->get();
        $data['brands'] = Brand::where('BRND_ACTV', 1)->get();
        $data['types'] = CarType::with(['cars', 'cars.model'])->get();
        $data['years'] = CarModel::getModelYears();
        $data['carsMin'] = Car::selectRaw('MIN(CAR_PRCE) as mini')->first()->mini ?? 0;
        $data['carsMax'] = Car::selectRaw('MAX(CAR_PRCE) as maxi')->first()->maxi ?? 1000000;
        $data['carsShwya'] = round(($data['carsMax']-$data['carsMin'])/5);

        //URLs
        $data['searchURL'] = url('search');
        $data['compareURL'] = url('compare');
        $data['aboutusURL'] = url('aboutus');
        $data['calculateURL'] = url('calculator');


        return $data;
    }

    public static function getSearchResults($type, $brand, $year, $model, $priceFrom, $priceTo){
        $query = Car::join('models', 'CAR_MODL_ID', '=', 'models.id')->join('brands', 'MODL_BRND_ID', '=', 'brands.id')
                            ->join('types', 'MODL_TYPE_ID', '=', 'types.id');
        if($type && is_numeric($type)){
            CarType::findOrFail($type);
            $query = $query->where("MODL_TYPE_ID", $type);
        }

        if($brand && is_numeric($brand)){
            Brand::findOrFail($brand);
            $query = $query->where("MODL_BRND_ID", $brand);
        }

        if($model && is_numeric($model)){
            CarModel::findOrFail($model);
            $query = $query->where("models.id", $model);
        }

        if($year && is_numeric($year)){
            $query = $query->where("MODL_YEAR", $year);
        }

        if($priceFrom && is_numeric($priceFrom)){
            $query = $query->where("CAR_PRCE", ">=", $priceFrom);
        }

        if($priceTo && is_numeric($priceTo)){
            $query = $query->where("CAR_PRCE", "<=", $priceTo);
        }

        return $query->get();
    }
}
