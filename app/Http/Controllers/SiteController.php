<?php

namespace App\Http\Controllers;

use App\Mail\RequestInfo;
use App\Models\Bank;
use App\Models\ContactUs;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\Customer;
use App\Models\Downpayment;
use App\Models\Insurance;
use App\Models\Partner;
use App\Models\Plan;
use App\Models\SiteInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    function home(Request $request)
    {
        $data = self::getDefaultSiteInfo(true, "Home", null, null, true, $request);
        $data['mainModels']  =   CarModel::join('brands', 'MODL_BRND_ID', '=', 'brands.id')->where('BRND_ACTV', 1)
            ->select('brands.*', 'models.*')
            ->where('MODL_ACTV', 1)->where('MODL_MAIN', 1)->orderByDesc('models.id')->limit(2)->get();
        $mainModelsCount = count($data['mainModels']);
        if ($mainModelsCount == 0) {
            $data['mainModels']  =  CarModel::join('brands', 'MODL_BRND_ID', '=', 'brands.id')->where('BRND_ACTV', 1)
                ->select('brands.*', 'models.*')->orderByDesc('models.id')->limit(2)->get();
        } elseif ($mainModelsCount == 1) {
            $extraModel = CarModel::join('brands', 'MODL_BRND_ID', '=', 'brands.id')->where('BRND_ACTV', 1)
                ->where('MODL_ACTV', 1)->where('MODL_MAIN', 0)->select('brands.*', 'models.*')->orderByDesc('models.id')
                ->get()->first();
            if ($extraModel)
                $data['mainModels']->push($extraModel);
        }
        if (isset($data['frontendData']['Offers']) && $data['frontendData']['Offers']['Active']) {
            $data['offers'] = Car::join('models', 'CAR_MODL_ID', '=', 'cars.id')
                ->join('brands', 'MODL_BRND_ID', '=', 'brands.id')
                ->select('brands.*', 'models.*', 'cars.*')
                ->where('CAR_OFFR', 1)->where('CAR_ACTV', 1)
                ->where('BRND_ACTV', 1)->where('MODL_ACTV', 1)
                ->get();
        }
        if (isset($data['frontendData']['rending cars']) && $data['frontendData']['Trending cars']['Active']) {
            $data['trends'] = Car::join('models', 'CAR_MODL_ID', '=', 'cars.id')
                ->join('brands', 'MODL_BRND_ID', '=', 'brands.id')
                ->select('brands.*', 'models.*', 'cars.*')
                ->where('CAR_TRND', 1)->where('CAR_ACTV', 1)
                ->where('BRND_ACTV', 1)->where('MODL_ACTV', 1)
                ->get();
        }
        if (isset($data['frontendData']['Customers']) && $data['frontendData']['Customers']['Active']) {
            $data['customers'] = Customer::all();
        }
        return view('frontend.home', $data);
    }

    function model(Request $request, $id)
    {
        $model = CarModel::with('cars', 'type', 'brand', 'colorImages')->findOrFail($id);
        $model->id = $id;
        $data = self::getDefaultSiteInfo(false, $model->MODL_NAME, $model->MODL_BGIM ? asset('storage/' . $model->MODL_BGIM ) : null, $model->brand->BRND_NAME . ' ' . $model->MODL_NAME . ' ' . $model->MODL_YEAR . '\'s Categories', true, $request);
        $data['carList'] = $model->cars;
        $data['model'] = $model;

        return view('frontend.list', $data);
    }

    function car(Request $request, $id)
    {
        $car = Car::with('model', 'model.brand', 'model.type')->findOrFail($id);
        $data = self::getDefaultSiteInfo(false, $car->model->MODL_NAME . ' ' . $car->CAR_CATG, null, null, false, $request);
        $data['similar'] = Car::with('model', 'model.brand')->where("CAR_MODL_ID", $car->model->id)->where("cars.id", "!=", $id)->get();
        $data['car'] = $car;
        $data['carAccessories'] = $car->getFullAccessoriesArray();

        //loan calculator 
        $data['downpayments']   =   Downpayment::all();
        $data['insurances']     =   Insurance::all(); 

        //URLs
        $data['getCarsURL'] = url('get/cars');
        $data['getYearsURL'] = url('get/years');
        $data['getPlansURL'] = url('get/plans');
        $data['getCarsURL'] = url('get/cars');

        return view('frontend.car', $data);
    }

    function compare(Request $request)
    {
        $data = self::getDefaultSiteInfo(false, "Compare Cars", null, "Compare up to three different cars", true, $request);
        $formInputCount = 0;

        if (isset($request->car1) && $request->car1 != 0) {
            $data['cars'][$formInputCount] = Car::with('model', 'model.brand', 'model.type')->findOrFail($request->car1);
            $data['cars'][$formInputCount]['accessories'] = $data['cars'][$formInputCount]->getFullAccessoriesArray();
            $formInputCount++;
        }
        if (isset($request->car2) && $request->car2 != 0) {
            $data['cars'][$formInputCount] = Car::with('model', 'model.brand', 'model.type')->findOrFail($request->car2);
            $data['cars'][$formInputCount]['accessories'] = $data['cars'][$formInputCount]->getFullAccessoriesArray();
            $formInputCount++;
        }
        if (isset($request->car3) && $request->car3 != 0) {
            $data['cars'][$formInputCount] = Car::with('model', 'model.brand', 'model.type')->findOrFail($request->car3);
            $data['cars'][$formInputCount]['accessories'] = $data['cars'][$formInputCount]->getFullAccessoriesArray();
            $formInputCount++;
        }
        if (isset($request->car4) && $request->car4 != 0) {
            $data['cars'][$formInputCount] = Car::with('model', 'model.brand', 'model.type')->findOrFail($request->car4);
            $data['cars'][$formInputCount]['accessories'] = $data['cars'][$formInputCount]->getFullAccessoriesArray();
            $formInputCount++;
        }

        if ($formInputCount > 1) {
            $data['count'] = $formInputCount;
            $data['headerWidth'] = (1 / ($formInputCount + 1)) * 100;
            $request->session()->remove("compareArr");

            return view('frontend.compare', $data);
        }

        if (count($data['compareArr']) < 2) {
            return $this->prepareCompare($request);
        }
        $i = 0;
        foreach ($data['compareArr'] as $carID) {
            $data['cars'][$i] = Car::with('model', 'model.brand', 'model.type')->findOrFail($carID);
            $data['cars'][$i]['accessories'] = $data['cars'][$i]->getFullAccessoriesArray();
            $i++;
        }
        $data['count'] = $i;
        $data['headerWidth'] = (1 / ($i + 1)) * 100;

        return view('frontend.compare', $data);
    }

    function prepareCompare(Request $request)
    {
        $data = self::getDefaultSiteInfo(false, "Compare Cars", null, "Select up to 4 cars for comparison", true, $request);
        $data['getCarsURL'] = url('get/cars');
        if (count($data['compareArr']) == 1) {
            $data['car1'] = Car::find(array_pop($data['compareArr']));
            $data['cars1Model'] = Car::where('CAR_MODL_ID', $data['car1']->CAR_MODL_ID)->get();
        }
        return view('frontend.preparecompare', $data);
    }

    function calculator(Request $request)
    {
        $data = self::getDefaultSiteInfo(false, "Car Loans", null, "Select your car & Calculate Loan Plans", true, $request);
        $data['downpayments']   =   Downpayment::all();
        $data['insurances']     =   Insurance::all(); 

        //URLs
        $data['getCarsURL'] = url('get/cars');
        $data['getYearsURL'] = url('get/years');
        $data['getPlansURL'] = url('get/plans');
        $data['getCarsURL'] = url('get/cars');

        return view('frontend.calculator', $data);
    }

    function contactus(Request $request)
    {
        $data = self::getDefaultSiteInfo(false, "Contact Us", null, "We are looking to hear from you :)", true, $request);
        $data['sendMailURL'] = url('send/email');
        return view("frontend.contactus", $data);
    }

    function sendMail(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "phone" => "required",
            "message" => "required|min:20"
        ]);

        Mail::to("mina9492@hotmail.com")->send(new RequestInfo($request->name, $request->email, $request->phone, $request->message));
        echo "1";
    }

    function search(Request $request)
    {
        $data = self::getDefaultSiteInfo(false, "Find Your Car", null, "Find your search results below", true, $request);
        $prices = explode(',', $request->priceRange);
        $data['carList'] = self::getSearchResults($request->typeID, $request->brandID, $request->modelID, $request->year, $prices[0] ?? $data['carsMin'], $prices[1] ?? $data['carsMax']);

        if ($data['carList']->count() > 0)
            return view('frontend.list', $data);
        else return view('frontend.nosearch', $data);
    }

    public static function getDefaultSiteInfo(bool $carouselHeader, string $pageTitle, string $headerImage = null, string $pageSubtitle = null, $isHeader = true, Request $request = null)
    {

        //make sure everychange here should be reflected on 404 page
        $data['carouselHeader'] = $carouselHeader;
        $data['headerImage'] = $headerImage;
        $data['pageSubtitle'] = $pageSubtitle;
        $data['pageTitle'] = $pageTitle;
        $data['isHeader'] = $isHeader;
        $data['topCars']  =   Car::with(["model", "model.brand"])->orderByDesc('CAR_VLUE')->limit(5)->get();

        $data['contactUs']  =   ContactUs::getContactUs();
        $data['frontendData'] =   SiteInfo::getSiteInfo();
        $data['partners'] =   Partner::all();


        //Search Form
        $data['models']   =   CarModel::with(["brand"])->join("brands", "MODL_BRND_ID", '=', 'brands.id')
            ->where('MODL_ACTV', 1)->where('BRND_ACTV', 1)->select("brands.BRND_NAME", 'models.*')->get();
        $data['brands'] = Brand::where('BRND_ACTV', 1)->get();
        $data['types'] = CarType::with(['cars', 'cars.model'])->get();
        $data['years'] = CarModel::getModelYears();
        $data['carsMin'] = Car::selectRaw('MIN(CAR_PRCE) as mini')->first()->mini ?? 0;
        $data['carsMax'] = Car::selectRaw('MAX(CAR_PRCE) as maxi')->first()->maxi ?? 1000000;
        $data['carsShwya'] = round(($data['carsMax'] - $data['carsMin']) / 5);

        //URLs
        $data['searchURL'] = url('search');
        $data['compareURL'] = url('compare');
        $data['contactusURL'] = url('contactus');
        $data['calculateURL'] = url('calculator');
        $data['addToCompareURL'] = url('compare/add');
        $data['removeFromCompareURL'] = url('compare/remove');

        $data['compareArr'] = [];
        //compare array
        if ($request !== null)
            $data['compareArr'] = $request->session()->get('compareArr') ?? [];

        return $data;
    }

    public static function getSearchResults($type, $brand,  $model, $year, $priceFrom, $priceTo)
    {
        $query = Car::join('models', 'CAR_MODL_ID', '=', 'models.id')->join('brands', 'MODL_BRND_ID', '=', 'brands.id')
            ->join('types', 'MODL_TYPE_ID', '=', 'types.id')
            ->select('cars.*', 'models.MODL_NAME', 'models.MODL_YEAR', "types.TYPE_NAME", "brands.BRND_NAME");
        if ($type && is_numeric($type) && $type>0) {
            CarType::findOrFail($type);
            $query = $query->where("MODL_TYPE_ID", $type);
        }

        if ($brand && is_numeric($brand) && $brand>0) {
            Brand::findOrFail($brand);
            $query = $query->where("MODL_BRND_ID", $brand);
        }

        if ($model && is_numeric($model) && $model>0) {
            CarModel::findOrFail($model);
            $query = $query->where("CAR_MODL_ID", $model);
        }

        if ($year && is_numeric($year) && $year > 2000) {
            $query = $query->where("MODL_YEAR", $year);
        }

        if ($priceFrom && is_numeric($priceFrom)) {
            $query = $query->where("CAR_PRCE", ">=", $priceFrom);
        }

        if ($priceTo && is_numeric($priceTo)) {
            $query = $query->where("CAR_PRCE", "<=", $priceTo);
        }

        return $query->get();
    }
}
