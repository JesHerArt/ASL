<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;
use Input;
use Hash;
use Redirect;
use Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    protected function accountForm () {
        return view('create_account_cust');
    }
    
    protected function accountMain () {
        
        $userId = \Auth::id();
        
        $customerQuery = \DB::table('users')
                            ->leftJoin('contacts', function($join)
                            {
                                $join->on('contacts.userId', '=','users.id');  
                            })
                            ->leftJoin('accounts', function($join)
                            {
                                $join->on('accounts.id', '=','contacts.accountId');  
                            })
                            ->leftJoin('accnt_statuses', function($join)
                            {
                                $join->on('accnt_statuses.id', '=','accounts.accountStatus');  
                            })
                            ->where('users.id', '=', $userId)->first();
        
        $contactType = \DB::table('contact_types')->where('id','=',$customerQuery->contactTypeId)->first()->contactType;
        
        $accntID = $customerQuery->accountId;
        
        $balance = \DB::table('balances')->where('accountId','=',$accntID)->first()->balance;
        
        $customerData = [
            'name'      => $customerQuery->firstName . ' ' . $customerQuery->lastName,
            'company'   => $customerQuery->companyName,
            'address1'  => $customerQuery->streetAddress,
            'address2'  => $customerQuery->city . ', ' . $customerQuery->state . ' ' . $customerQuery->zipcode,
            'username'  => $customerQuery->username,
            'email'     => $customerQuery->email,
            'phone'     => $customerQuery->phone,
            'contact'   => $contactType,
            'status'    => $customerQuery->status,
            'balance'   => $balance
        ];
        
        return view('account_main', $customerData);
    }
    
    protected function editPassword() {
        
        $authUserId = \Auth::id();
        
        $authContact = Contact::where('userId','=',$authUserId)->first();
        
        $employeeData = [
            'contactId' => $authContact->id,
            'userId'    => $authUserId
        ];
        
        return view('customer_edit_pass', $employeeData);
    }
    
    protected function updatePassword() {
        
        $user = \Auth::user();
        
        $rules = array(
            'oldPassword' => 'required',
            'newPassword' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        
        $old = Input::get('oldPassword');
        $new = Input::get('newPassword');

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            if ( !Hash::check($old, $user->password)) {
                return redirect()->back()->withErrors('Your old password does not match');
            } else {
                $user->password = bcrypt($new);
                $user->save();
                
                return Redirect::to('/account');
            }
        }
        
    }
    
    
}
