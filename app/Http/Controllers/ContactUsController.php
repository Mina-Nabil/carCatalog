<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    protected $homeURL = 'admin/manage/contact';
    protected $updateURL = 'admin/update/contact';
    protected $aboutUs;

    function home(){
        $this->aboutUs = ContactUs::getContactUs();
        $this->aboutUs['formTitle'] = 'Manage "Contact Us" Info';
        $this->aboutUs['formURL'] = url($this->updateURL);
        return view('meta.contactus', $this->aboutUs);
    }

    function update(Request $request){
        $request->validate([
            'item' => 'required',
        ]);

        $aboutUsRow = ContactUs::firstOrNew(['ABUT_ITEM' => $request->item]);
        $aboutUsRow->ABUT_CNTN = $request->content ?? NULL;

        echo $aboutUsRow->save();
    }

}
