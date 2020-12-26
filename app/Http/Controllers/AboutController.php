<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $homeURL = 'admin/manage/about';
    protected $updateURL = 'admin/update/about';
    protected $aboutUs;

    function home(){
        $this->aboutUs = AboutUs::getAboutUs();
        $this->aboutUs['formTitle'] = 'Manage About Us Info';
        $this->aboutUs['formURL'] = url($this->updateURL);
        return view('meta.aboutus', $this->aboutUs);
    }

    function update(Request $request){
        $request->validate([
            'item' => 'required',
        ]);

        $aboutUsRow = AboutUs::firstOrNew(['ABUT_ITEM' => $request->item]);
        $aboutUsRow->ABUT_CNTN = $request->content ?? NULL;

        echo $aboutUsRow->save();
    }

}
