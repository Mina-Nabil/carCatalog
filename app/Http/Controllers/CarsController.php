<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarsController extends Controller
{

    protected $data;
    protected $homeURL = "admin/cars/show";

    public function home(){
        $this->initDataArr();
        return view('cars.show', $this->data);
    }

    public function insert(Request $request){
        $request->validate([
            "model"     => "required|exists:models,id",
            "category"  => "required",
            "price"     => "required",
            "cc"        =>  "required_if:isActive,on",
            "hpwr"      =>  "required_if:isActive,on",
            "torq"      =>  "required_if:isActive,on",
            "trns"      =>  "required_if:isActive,on",
            "speed"     =>  "required_if:isActive,on",
            "height"    =>  "required_if:isActive,on",
            "rims"      =>  "required_if:isActive,on",
            "tank"      =>  "required_if:isActive,on",
            "seat"      =>  "required_if:isActive,on",
            "title1"    =>  "required_if:isActive,on",
            "prgp1"    =>  "required_if:isActive,on",
            "prgp2"    =>  "required_if:title2,true",
        ]);

        $car = new Car();
        //info
        $car->CAR_MODL_ID   =   $request->model;
        $car->CAR_CATG      =   $request->category;
        $car->CAR_PRCE      =   $request->price;
        $car->CAR_DISC      =   $request->discount ?? 0;
        $car->CAR_VLUE      =   $request->sort ?? 500;
        
        //specs
        $car->CAR_ENCC      =   $request->cc;
        $car->CAR_HPWR      =   $request->hpwr;
        $car->CAR_TORQ      =   $request->torq;
        $car->CAR_TRNS      =   $request->trns;
        $car->CAR_ACC       =   $request->acc;
        $car->CAR_TPSP      =   $request->speed;
        $car->CAR_HEIT      =   $request->height;
        $car->CAR_TRNK      =   $request->tank;
        $car->CAR_RIMS      =   $request->rims;
        $car->CAR_SEAT      =   $request->seat;
        
        //overview
        $car->CAR_TTL1      =   $request->title1;
        $car->CAR_PRG1      =   $request->prgp1;
        $car->CAR_TTL2      =   $request->title2;
        $car->CAR_PRG2      =   $request->prgp2;

        $car->save();

        return redirect('admin/cars/profile/' . $car->id);

    }

    public function update(Request $request){
        $request->validate([
            "id"        => "required",
            "model"     => "required|exists:models,id",
            "category"  => "required",
            "price"     => "required",
            "cc"        =>  "required_if:isActive,on",
            "hpwr"      =>  "required_if:isActive,on",
            "torq"      =>  "required_if:isActive,on",
            "trns"      =>  "required_if:isActive,on",
            "speed"     =>  "required_if:isActive,on",
            "height"    =>  "required_if:isActive,on",
            "rims"      =>  "required_if:isActive,on",
            "tank"      =>  "required_if:isActive,on",
            "seat"      =>  "required_if:isActive,on",
            "title1"    =>  "required_if:isActive,on",
            "prgp1"    =>  "required_if:isActive,on",
            "prgp2"    =>  "required_if:title2",
        ]);

        $car = Car::findOrFail($request->id);

        //info
        $car->CAR_MODL_ID   =   $request->model;
        $car->CAR_CATG      =   $request->category;
        $car->CAR_PRCE      =   $request->price;
        $car->CAR_DISC      =   $request->discount;
        $car->CAR_VLUE      =   $request->sort;
        
        //specs
        $car->CAR_ENCC      =   $request->cc;
        $car->CAR_HPWR      =   $request->hpwr;
        $car->CAR_TORQ      =   $request->torq;
        $car->CAR_TRNS      =   $request->trns;
        $car->CAR_ACC       =   $request->acc;
        $car->CAR_TPSP      =   $request->speed;
        $car->CAR_HEIT      =   $request->height;
        $car->CAR_TRNK      =   $request->tank;
        $car->CAR_RIMS      =   $request->rims;
        $car->CAR_SEAT      =   $request->seat;
        
        //overview
        $car->CAR_TTL1      =   $request->title1;
        $car->CAR_PRG1      =   $request->prgp1;
        $car->CAR_TTL2      =   $request->title2;
        $car->CAR_PRG2      =   $request->prgp2;

        $car->save();

        return redirect('admin/cars/profile/' . $car->id);

    }


    public function add(){
        $this->initAddArr();
        $this->data['formTitle'] = "New Car Profile";
        $this->data['formURL'] = "admin/cars/insert";
        $this->data['isCancel'] = false;
        return view('cars.add', $this->data);
    }

    //////////////////// Data functions
    private function initProfileArr($modelID)
    {
        $this->data['model'] = Car::with('model', 'model.brand', 'model.type', 'accessories')->findOrFail($modelID);

        //Accessories table
        $this->data['items'] = $this->data['model']->cars;
        $this->data['title'] = "Available Categories";
        $this->data['subTitle'] = "Check all Available Model categories";
        $this->data['cols'] = ['#', 'Category'];
        $this->data['atts'] = [
            'CAR_VLUE',
            ['dynamicUrl' => ['att' => 'CAR_NAME', 'val' => 'id', 'baseUrl' => 'admin/cars/profile/']],
        ];
    }

    private function initDataArr()
    {
        $this->data['items'] = Car::with(["model.brand", "model.type"])->orderBy('CAR_VLUE', 'desc')->get();
        $this->data['title'] = "Available Cars";
        $this->data['subTitle'] = "Check all Available Cars";
        $this->data['cols'] = ['Category', 'Model', 'Year', 'Active'];
        $this->data['atts'] = [
            ['dynamicUrl' => ['att' => 'CAR_CATG', 'val' => 'id', 'baseUrl' => 'admin/cars/profile/']],
            ['foreignUrl' => ['rel' => 'model', 'att' => 'MODL_NAME', 'baseUrl' => 'admin/models/profile', 'urlAtt' => 'id']],
            ['foreign' => ['rel' => 'model', 'att' => 'MODL_YEAR']],
            [
                'toggle' => [
                    "att"   =>  "CAR_ACTV",
                    "url"   =>  "admin/cars/toggle/",
                    "states" => [
                        "1" => "Active",
                        "0" => "Hidden",
                    ],
                    "actions" => [
                        "1" => "hide the car",
                        "0" => "publish the model",
                    ],
                    "classes" => [
                        "1" => "label-success",
                        "0" => "label-danger",
                    ],
                ]
            ],
        ];
        $this->data['homeURL'] = $this->homeURL;
    }

    private function initAddArr()
    {
        $this->data['models'] = CarModel::with('brand', 'type')->get();
        return view('cars.add', $this->data);
    }
}
