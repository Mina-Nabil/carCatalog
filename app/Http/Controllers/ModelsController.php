<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModelsController extends Controller
{
    protected $data;
    protected $homeURL = 'models/show';
    protected $profileURL = 'models/profile/';

    public function profile($id){
        $this->initProfileArr($id);
        return view('models.profile', $this->data);
    }


    public function home()
    {
        $this->initDataArr();
        return view('models.show', $this->data);
    }
    public function add()
    {
        $this->initAddArr();
        $this->data['formTitle'] = "Add Car Model";
        $this->data['formURL'] = "models/insert";
        $this->data['isCancel'] = false;
        return view('models.add', $this->data);
    }

    public function insert(Request $request)
    {

        $request->validate([
            "name"      => "required|unique:models,MODL_NAME",
            "brand"      => "required|exists:brands,id",
            "type"      => "required|exists:types,id",
            "year"      => "required",
            "overview"  => "required_if:isMain,on",
            "image"  => "required_if:isMain,on|file"
        ]);

        $model = new CarModel();
        $model->MODL_BRND_ID = $request->brand;
        $model->MODL_TYPE_ID = $request->type;
        $model->MODL_NAME = $request->name;
        $model->MODL_ARBC_NAME = $request->arbcName;
        $model->MODL_YEAR = $request->year;
        $model->MODL_OVRV = $request->overview;
        if ($request->hasFile('image')) {
            $model->MODL_IMGE = $request->image->store('images/models/' . $model->MODL_NAME, 'public');
        }
        $model->MODL_ACTV = $request->isActive == 'on' ? 1 : 0;
        $model->MODL_MAIN = $request->isMain == 'on' ? 1 : 0;


        $model->save();
        return redirect($this->profileURL . $model->id);
    }

    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
        ]);
        $model = CarModel::findOrFail($request->id);

        $request->validate([
            "name" => ["required",  Rule::unique('models', "MODL_NAME")->ignore($model->MODL_NAME, "MODL_NAME"),],
            "id"        => "required",
            "brand"      => "required|exists:brands,id",
            "type"      => "required|exists:types,id",
            "year"      => "required",
            "overview"  => "required_if:isMain,on",
            "image"  => "required_if:isMain,on|file"
        ]);

        $model->MODL_BRND_ID = $request->brand;
        $model->MODL_TYPE_ID = $request->type;
        $model->MODL_NAME = $request->name;
        $model->MODL_ARBC_NAME = $request->arbcName;
        $model->MODL_YEAR = $request->year;
        if ($request->hasFile('image')) {
            $model->MODL_IMGE = $request->image->store('images/models/' . $model->MODL_NAME, 'public');
        }
        $model->MODL_ACTV = $request->isActive == 'on' ? 1 : 0;
        $model->MODL_MAIN = $request->isMain == 'on' ? 1 : 0;
        $model->save();

        return redirect($this->profileURL . $model->id);
    }

    public function toggleMain($id)
    {
        $model = CarModel::findOrFail($id);
        $model->toggleMain();
        return back();
    }

    public function toggleActive($id)
    {
        $model = CarModel::findOrFail($id);
        $model->toggleActive();
        return back();
    }

    ////////?Data functions
    private function initProfileArr($modelID){
        $this->data['model'] = CarModel::with('cars', 'type', 'brand')->findOrFail($modelID);

    }

    private function initDataArr()
    {
        $this->data['items'] = CarModel::orderBy('MODL_ACTV')->get();
        $this->data['title'] = "Available Models";
        $this->data['subTitle'] = "Check all Available Models";
        $this->data['cols'] = ['Image', 'Name', 'Arabic', 'Year', 'Active', 'Main', 'Overview'];
        $this->data['atts'] = [
            ['assetImg' => ['att' => 'MODL_IMGE']],
            ['dynamicUrl' => ['att' => 'MODL_NAME', 'val' => 'id', 'baseUrl' => 'models/profile/']],
            ['dynamicUrl' => ['att' => 'MODL_ARBC_NAME', 'val' => 'id', 'baseUrl' => 'models/profile/']],
            'MODL_YEAR',
            [
                'toggle' => [
                    "att"   =>  "MODL_ACTV",
                    "url"   =>  "models/toggle/active/",
                    "states" => [
                        "1" => "Active",
                        "0" => "Hidden",
                    ],
                    "actions" => [
                        "1" => "hide the model",
                        "0" => "show the model",
                    ],
                    "classes" => [
                        "1" => "label-success",
                        "0" => "label-danger",
                    ],
                ]
            ],
            [
                'toggle' => [
                    "att"   =>  "MODL_MAIN",
                    "url"   =>  "models/toggle/main/",
                    "states" => [
                        "1" => "True",
                        "0" => "False",
                    ],
                    "actions" => [
                        "1" => "hide the model from home page",
                        "0" => "show the model on the home page, please make sure the model has an image and an overview",
                    ],
                    "classes" => [
                        "1" => "label-info",
                        "0" => "label-warning",
                    ],
                ]
            ],
            ['comment'=>['att' => 'MODL_OVRV', 'title' => 'Overview']]
        ];
        $this->data['homeURL'] = $this->homeURL;
    }

    private function initAddArr()
    {
        $this->data['brands'] = Brand::all();
        $this->data['types'] = CarType::all();

        return view('models.add', $this->data);
    }
}
