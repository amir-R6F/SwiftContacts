<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ContactRepository(new Contacts);
    }

    public function getContacts()
    {
        $authuser = auth()->user()->id;
        $allContact = Contacts::where('user_id', $authuser)->with("optionValue")->get();
        return response()->json(["contacts" => $allContact]);
    }

    public function updateOrStore(Request $request)
    {
        $request["static_value"] += ["user_id" => auth()->user()->id];
        $contact = Contacts::updateOrCreate(['id' => $request->id], $request->static_value);
        if ($request->option_value) {
            foreach ($request->option_value as $op) {
                $option [] = $contact->optionValue()->updateOrCreate(['id' => $op["id"]], $op);
            }
            $contact["option_value"] = $option;
            $contact["message"] = "Update successfully";
        }
        return $contact;
    }

    public function delete(Request $request)
    {
        return $this->contacts->delete($request);
    }
}
