<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{
    protected function portalSettings() {
        
        $userId = \Auth::id();
        
        $userTypeID = \Auth::user()->userTypeId;
        $empType = \DB::table('user_types')->where('id', '=', $userTypeID)->first()->userType;
        
        $employeeQuery = \DB::table('users')
                            ->leftJoin('employees', function($join)
                            {
                                $join->on('employees.userId', '=','users.id');  
                            })
                            ->where('users.id', '=', $userId)->first();
        
        $primaryStore = \DB::table('stores')->where('id', '=', $employeeQuery->primaryStoreId)->first();
        
        $employeeData = [
            'name'      => $employeeQuery->firstName . ' ' . $employeeQuery->lastName,
            'empId'     => $employeeQuery->id,
            'address1'  => $employeeQuery->streetAddress,
            'address2'  => $employeeQuery->city . ', ' . $employeeQuery->state . ' ' . $employeeQuery->zipcode,
            'store'     => $primaryStore->location,
            'email'     => $employeeQuery->email,
            'phone'     => $employeeQuery->phone,
            'username'  => $employeeQuery->username,
            'rate'      => $employeeQuery->hourlyRate,
            'type'      => $empType
        ];
        
        return view('portal_settings', $employeeData);
    }
}
