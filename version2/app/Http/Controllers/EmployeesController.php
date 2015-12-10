<?php

namespace App\Http\Controllers;

use Input;
use Hash;
use Redirect;
use App\User;
use App\Employee;
use App\Timesheet;
use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{
    protected function portalSettings() {
        
        $userId = \Auth::id();
        
        $userTypeID = \Auth::user()->userTypeId;
        $empType = \DB::table('user_types')->where('id', '=', $userTypeID)->first()->userType;
        
        $authEmployee = \DB::table('users')
                            ->leftJoin('employees', function($join)
                            {
                                $join->on('employees.userId', '=','users.id');  
                            })
                            ->where('users.id', '=', $userId)->first();
        
        $primaryStore = \DB::table('stores')->where('id', '=', $authEmployee->primaryStoreId)->first();
        
        $employeeData = [
            'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
            'empId'     => $authEmployee->id,
            'address1'  => $authEmployee->streetAddress,
            'address2'  => $authEmployee->city . ', ' . $authEmployee->state . ' ' . $authEmployee->zipcode,
            'store'     => $primaryStore->location,
            'email'     => $authEmployee->email,
            'phone'     => $authEmployee->phone,
            'username'  => $authEmployee->username,
            'rate'      => $authEmployee->hourlyRate,
            'type'      => $empType
        ];
        
        return view('portal_settings', $employeeData);
    }
    
    protected function portalEmployees() {
        
        $userId = \Auth::id();
        
        $authEmployee = \DB::table('users')
                            ->leftJoin('employees', function($join)
                            {
                                $join->on('employees.userId', '=','users.id');  
                            })
                            ->where('users.id', '=', $userId)->first();
        
        $allEmployeesResult = \DB::table('employees')->get();
        
        $employees = array();
        
        foreach ( $allEmployeesResult as $employee ) {
            $empObject = array();
            
            $userID = $employee->userId;
            $userInfo = \DB::table('users')->where('id','=',$userID)->first();
            $userTypeID = $userInfo->userTypeId;
            $type = \DB::table('user_types')->where('id','=',$userTypeID)->first()->userType;
            $locationID = $employee->primaryStoreId;
            $location = \DB::table('stores')->where('id', '=', $locationID)->first()->location;
            
            $empObject = [
                'id'        => $employee->id,
                'name'      => $employee->firstName . ' ' . $employee->lastName,
                'username'  => $userInfo->username,
                'type'      => $type,
                'location'  => $location
            ];
            
            $employees[] = $empObject;
        }
        
        $employeeData = [
            'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
            'employees' => $employees
        ];
        
        return view('portal_employees', $employeeData);
    }
    
    protected function portalEditEmployee($id) {
        
        $empID = $id;
        
        $authUserId = \Auth::id();
        
        $authEmployee = \DB::table('users')
                            ->leftJoin('employees', function($join)
                            {
                                $join->on('employees.userId', '=','users.id');  
                            })
                            ->where('users.id', '=', $authUserId)->first();
        
        $empQuery = \DB::table('employees')
                            ->leftJoin('users', function($join)
                            {
                                $join->on('users.id', '=','employees.userId');  
                            })
                            ->where('employees.id', '=', $empID)->first();
        
        $storesQuery = \DB::table('stores')->get();
        
        $stores = array();
        
        foreach ( $storesQuery as $store ) {
            $storeObject = array();
            
            $storeObject = [
                'id' => $store->id,
                'location' => $store->location
            ];
            
            $stores[] = $storeObject;
        }
        
        $typesQuery = \DB::table('user_types')->get();
        
        $types = array();
        
        foreach ( $typesQuery as $type ) {
            $typeObject = array();
            
            $typeObject = [
                'id' => $type->id,
                'type' => $type->userType
            ];
            
            $types[] = $typeObject;
        }
        
        $employee = [
            'id' => $empID,
            'userId' => $empQuery->userId,
            'fName' => $empQuery->firstName,
            'lName' => $empQuery->lastName,
            'email' => $empQuery->email,
            'phone' => $empQuery->phone,
            'streetAddress' => $empQuery->streetAddress,
            'city' => $empQuery->city,
            'state' => $empQuery->state,
            'zipcode' => $empQuery->zipcode,
            'ssn' => $empQuery->ssn,
            'rate' => $empQuery->hourlyRate,
            'store' => $empQuery->primaryStoreId,
            'type' => $empQuery->userTypeId
        ];
        
        $data = [
            'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
            'employee' => $employee,
            'stores' => $stores,
            'types' => $types
        ];
        
        return view('portal_edit_emp', $data);
    }
    
    protected function portalUpdateEmployee() {
        
        $empId = Input::get('empId');
        $userId = Input::get('userId');
        $fName = Input::get('firstName');
        $lName = Input::get('lastName');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $streetAddress = Input::get('streetAddress');
        $city = Input::get('city');
        $state = Input::get('state');
        $zipcode = Input::get('zipcode');
        $ssn = Input::get('ssn',null);
        $rate = Input::get('rate');
        $store = Input::get('store');
        $userType = Input::get('userType');
        
        $user = User::where('id','=',$userId)->first();
        $user->userTypeId = $userType;
        $user->updated_at = gmdate("Y-m-d H:i:s");
        $user->save();
        
        $employee = Employee::where('id','=',$empId)->first();
        $employee->firstName = $fName;
        $employee->lastName = $lName;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->streetAddress = $streetAddress;
        $employee->city = $city;
        $employee->state = $state;
        $employee->zipcode = $zipcode;
        $employee->ssn = $ssn;
        $employee->hourlyRate = $rate;
        $employee->primaryStoreId = $store;
        $employee->updated_at = gmdate("Y-m-d H:i:s");
        $employee->save();
        
        return Redirect::to('/portal-employees');
        
    }
    
    protected function portalNewEmployeeForm() {
        
        $authUserId = \Auth::id();
        
        $authEmployee = \DB::table('users')
                            ->leftJoin('employees', function($join)
                            {
                                $join->on('employees.userId', '=','users.id');  
                            })
                            ->where('users.id', '=', $authUserId)->first();
        
        $storesQuery = \DB::table('stores')->get();
        
        $stores = array();
        
        foreach ( $storesQuery as $store ) {
            $storeObject = array();
            
            $storeObject = [
                'id' => $store->id,
                'location' => $store->location
            ];
            
            $stores[] = $storeObject;
        }
        
        $typesQuery = \DB::table('user_types')->get();
        
        $types = array();
        
        foreach ( $typesQuery as $type ) {
            $typeObject = array();
            
            $typeObject = [
                'id' => $type->id,
                'type' => $type->userType
            ];
            
            $types[] = $typeObject;
        }
        
        $data = [
            'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
            'stores'    => $stores,
            'types'     => $types
        ];
        
        
        return view('portal_new_emp', $data);
        
    }
    
    protected function portalCreateEmployee() {
        
        $fName = Input::get('firstName');
        $lName = Input::get('lastName');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $streetAddress = Input::get('streetAddress');
        $city = Input::get('city');
        $state = Input::get('state');
        $zipcode = Input::get('zipcode');
        $ssn = Input::get('ssn');
        $rate = Input::get('hourlyRate');
        $store = Input::get('primaryStoreId');
        $userType = Input::get('userTypeId');
        $username = Input::get('username');
        $password = Input::get('password');
        
        $newUser = User::create([
            'username'      => $username,
            'password'      => bcrypt($password),
            'created_at'    => gmdate('Y-m-d H:i:s'),
            'updated_at'    => gmdate('Y-m-d H:i:s'),
            'userTypeId'    => $userType
        ]);

        $userTypeId = $newUser->userTypeId;

        if ( $userTypeId == 1 || $userTypeId == 2) {

            $newEmployee = Employee::create([ 
                'userId'        => $newUser->id,
                'firstName'     => $fName,
                'lastName'      => $lName,
                'email'         => $email,
                'phone'         => $phone,
                'streetAddress' => $streetAddress,
                'city'          => $city,
                'state'         => $state,
                'zipcode'       => $zipcode,
                'ssn'           => $ssn,
                'hourlyRate'    => $rate,
                'primaryStoreId' => $store,
                'created_at'    => gmdate('Y-m-d H:i:s'),
            ]);

            $newTimesheet = Timesheet::create([
                'empId'    => $newEmployee->id,
                'sunday'    => 0,
                'monday'    => 0,
                'tuesday'   => 0,
                'wednesday' => 0,
                'thursday'  => 0,
                'friday'    => 0,
                'saturday'  => 0,
                'total'     => 0,
                'created_at'    => gmdate('Y-m-d H:i:s'),
            ]);

        }

        return Redirect::to('/portal-employees');
        
    }
    
    protected function portalEditSettings() {
        
        $authUserId = \Auth::id();
        
        $authEmployee = Employee::where('userId','=',$authUserId)->first();
        
        $employeeData = [
            'name'          => $authEmployee->firstName . ' ' . $authEmployee->lastName,
            'firstName'     => $authEmployee->firstName,
            'lastName'      => $authEmployee->lastName,
            'empId'         => $authEmployee->id,
            'email'         => $authEmployee->email,
            'phone'         => $authEmployee->phone,
            'streetAddress' => $authEmployee->streetAddress,
            'city'          => $authEmployee->city,
            'state'         => $authEmployee->state,
            'zipcode'       => $authEmployee->zipcode
        ];
        
        return view('portal_edit_settings', $employeeData);
    }
    
    protected function portalUpdateSettings() {
        
        $empId = Input::get('empId');
        $fName = Input::get('firstName');
        $lName = Input::get('lastName');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $streetAddress = Input::get('streetAddress');
        $city = Input::get('city');
        $state = Input::get('state');
        $zipcode = Input::get('zipcode');
        
        $employee = Employee::where('id','=',$empId)->first();
        $employee->firstName = $fName;
        $employee->lastName = $lName;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->streetAddress = $streetAddress;
        $employee->city = $city;
        $employee->state = $state;
        $employee->zipcode = $zipcode;
        $employee->updated_at = gmdate("Y-m-d H:i:s");
        $employee->save();
        
        return Redirect::to('/portal-settings');
        
    }
    
    protected function portalEditPassword() {
        
        $authUserId = \Auth::id();
        
        $authEmployee = Employee::where('userId','=',$authUserId)->first();
        
        $employeeData = [
            'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
            'empId'     => $authEmployee->id,
            'userId'    => $authUserId
        ];
        
        return view('portal_edit_pass', $employeeData);
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
                
                return Redirect::to('/portal-settings');
            }
        }
        
    }
    
    protected function portalTimesheet() {
        
        $authUserId = \Auth::id();
        
        $authEmployee = Employee::where('userId','=',$authUserId)->first();
        
        $empId = $authEmployee->id;
        
        $timesheet = Timesheet::where('empId','=',$empId)->first();
        
        $currentDate = date('l jS \of F Y');
        
        $employeeData = [
            'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
            'sun'   => $timesheet->sunday,
            'mon'   => $timesheet->monday,
            'tues'  => $timesheet->tuesday,
            'wed'   => $timesheet->wednesday,
            'thurs' => $timesheet->thursday,
            'fri'   => $timesheet->friday,
            'sat'   => $timesheet->saturday,
            'total' => $timesheet->total,
            'today' => "Today is: " . $currentDate
        ];
        
        return view('portal_timesheet', $employeeData);
    }
    
    protected function portalUpdateTimesheet() {
        
        $authUserId = \Auth::id();
        
        $authEmployee = Employee::where('userId','=',$authUserId)->first();
        
        $empId = $authEmployee->id;
        
        $timesheet = Timesheet::where('empId','=',$empId)->first();
        
        $sun = Input::get('sunday');
        $mon = Input::get('monday');
        $tues = Input::get('tuesday');
        $wed = Input::get('wednesday');
        $thurs = Input::get('thursday');
        $fri = Input::get('friday');
        $sat = Input::get('saturday');
        $total = $sun + $mon + $tues + $wed + $thurs + $fri + $sat;
        
        $timesheet->sunday = $sun;
        $timesheet->monday = $mon;
        $timesheet->tuesday = $tues;
        $timesheet->wednesday = $wed;
        $timesheet->thursday = $thurs;
        $timesheet->friday = $fri;
        $timesheet->saturday = $sat;
        $timesheet->total = $total;
        $timesheet->updated_at = gmdate("Y-m-d H:i:s");
        
        $timesheet->save();
        
        return Redirect::to('/portal-timesheet');
    }
    
}
