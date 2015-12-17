<?php

namespace App\Http\Controllers;

use Mail;
use Input;
use Hash;
use Redirect;
use App\User;
use App\Employee;
use App\Timesheet;
use App\Invoice;
use App\InvItems;
use App\Product;
use App\Balance;
use App\Account;
use App\Contact;
use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{
    protected function portalSettings() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
            
                $userId = \Auth::id();
        
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

            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalEmployees() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
                $userId = \Auth::id();
        
                $authEmployee = \DB::table('users')
                                    ->leftJoin('employees', function($join)
                                    {
                                        $join->on('employees.userId', '=','users.id');  
                                    })
                                    ->where('users.id', '=', $userId)->first();

                $allEmployeesResult = \DB::table('employees')->where('deleted_at','=',null)->get();

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

                $deletedEmployees = Employee::onlyTrashed()->get();

                $notEmployees = array();

                foreach ( $deletedEmployees as $employee ) {
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

                    $notEmployees[] = $empObject;
                }

                $employeeData = [
                    'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
                    'employees' => $employees,
                    'delEmployees' => $notEmployees
                ];

                return view('portal_employees', $employeeData);
                
            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalEditEmployee($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
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
                
            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalUpdateEmployee() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
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

            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalNewEmployeeForm() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
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

            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalCreateEmployee() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
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
                
            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {
                
                return Redirect::to('/account');
                
            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalEditSettings() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
            
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

            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalUpdateSettings() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
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
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalEditPassword() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $authUserId = \Auth::id();
        
                $authEmployee = Employee::where('userId','=',$authUserId)->first();

                $employeeData = [
                    'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
                    'empId'     => $authEmployee->id,
                    'userId'    => $authUserId
                ];

                return view('portal_edit_pass', $employeeData);
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function updatePassword() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
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
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalTimesheet() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
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
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalUpdateTimesheet() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
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
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalInvoices() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $authUserId = \Auth::id();
        
                $authEmployee = Employee::where('userId','=',$authUserId)->first();

                $invsQuery = \DB::table('invoices')->get();

                $invoices = array();

                foreach ( $invsQuery as $invoice ) {
                    $invObject = array();

                    $account = Account::where('id','=',$invoice->accountId)->first()->companyName;

                    $status = \DB::table('invoice_statuses')->where('id','=',$invoice->statusId)->first()->status;

                    $employeeUserId = Employee::where('id','=',$invoice->employeeId)->first()->userId;
                    $employee = User::where('id','=',$employeeUserId)->first()->username;

                    $date = $invoice->created_at;
                    $date = date("D, M. j, Y");

                    $invObject = [
                        'id' => $invoice->id,
                        'company' => $account,
                        'total' => $invoice->total,
                        'status' => $status,
                        'employee' => $employee,
                        'created' => $date
                    ];

                    $invoices[] = $invObject;
                }

                $data = [
                    'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
                    'invoices'  => $invoices
                ];

                return view('portal_invoices', $data);
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalNewInvoiceForm() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $authUserId = \Auth::id();
        
                $authEmployee = Employee::where('userId','=',$authUserId)->first();

                $accntsQuery = \DB::table('accounts')->where('accountStatus','=',1)->orderBy('companyName', 'asc')->get();

                $accounts = array();

                foreach ( $accntsQuery as $accnt ) {
                    $accntObject = array();

                    $accntObject = [
                        'id' => $accnt->id,
                        'name' => $accnt->companyName
                    ];

                    $accounts[] = $accntObject;
                }

                $productsQuery = \DB::table('products')->get();

                $products = array();

                foreach ( $productsQuery as $product ) {
                    $productObject = array();

                    $productObject = [
                        'id' => $product->id,
                        'name' => $product->name
                    ];

                    $products[] = $productObject;
                }

                $data = [
                    'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
                    'empId'     => $authEmployee->id,
                    'accounts'  => $accounts,
                    'products'  => $products
                ];

                return view('portal_new_invoice', $data);
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalNewInvoice() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $accntId = Input::get('accountId');
                $items = Input::get('items');
                $total = Input::get('total');
                $empId = Input::get('empId');

                $newInvoice = Invoice::create([
                    'accountId'  => $accntId,
                    'total'      => $total,
                    'statusId'   => 1,
                    'employeeId' => $empId,
                    'created_at' => gmdate('Y-m-d H:i:s')
                ]);

                $balance = Balance::where('accountId','=',$accntId)->first();

                $current = $balance->balance;

                $balance->balance = $current + $total;
                $balance->updated_at = gmdate("Y-m-d H:i:s");

                $balance->save();

                foreach ( $items as $item ) {
                    $newInvItem = InvItems::create([
                        'invoiceId' => $newInvoice->id,
                        'productId' => $item['id'],
                        'quantity'  => $item['quantity'],
                        'price'     => $item['price'],
                        'lineTotal' => $item['quantity'] * $item['price'],
                        'created_at' => gmdate('Y-m-d H:i:s')
                    ]);
                }

                return "success";
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalGetProducts() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $productsQuery = \DB::table('products')->get();
        
                $products['products'] = array();

                foreach ( $productsQuery as $product ) {
                    $productObject = array();

                    $productObject = [
                        'id' => $product->id,
                        'name' => $product->name
                    ];

                    $products['products'][] = $productObject;
                }

                return $products;
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalGetPrice($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $productId = $id;
        
                $product = Product::where('id','=',$productId)->first();

                $products['product'] = array();

                $productObject = array();

                $productObject = [
                    'id' => $productId,
                    'name' => $product->name,
                    'price' => $product->price
                ];

                $products['product'] = $productObject;

                return $products;
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalDeleteEmployee($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
                $empId = $id;
            
                $employee = Employee::where('id','=',$empId)->first();

                $empUserId = $employee->userId;

                $user = User::where('id','=',$empUserId)->first();

                $timesheet = Timesheet::where('empId','=',$empId)->first();

                $employee->delete();
                $user->delete();
                $timesheet->delete();

                return Redirect::to('/portal-employees');
                
            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalRestoreEmployee($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
                $empId = $id;
            
                $employee = Employee::onlyTrashed()->where('id','=',$empId)->first();

                $empUserId = $employee->userId;

                $user = User::onlyTrashed()->where('id','=',$empUserId)->first();

                $timesheet = Timesheet::onlyTrashed()->where('empId','=',$empId)->first();

                $employee->restore();
                $user->restore();
                $timesheet->restore();

                return Redirect::to('/portal-employees');
                
            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalCustomers() {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $authUserId = \Auth::id();
        
                $authEmployee = Employee::where('userId','=',$authUserId)->first();

                $accountsOpenQuery = \DB::table('accounts')->where('accountStatus','=','1')->get();

                $accountsOpen = array();

                foreach ( $accountsOpenQuery as $accnt ) {
                    $accntObject = array();

                    $contactQuery = Contact::where('accountId','=',$accnt->id)->get();

                    $contacts = array();

                    foreach ( $contactQuery as $contact ) {
                        $contactObject = array();

                        $type = \DB::table('contact_types')->where('id','=',$contact->contactTypeId)->first()->contactType;

                        $contactObject = [
                            'name' => $contact->firstName . ' ' . $contact->lastName,
                            'email' => $contact->email,
                            'phone' => $contact->phone,
                            'type' => $type
                        ];

                        $contacts[] = $contactObject;
                    }

                    $balance = Balance::where('accountId','=',$accnt->id)->first()->balance;

                    $accntObject = [
                        'id' => $accnt->id,
                        'name' => $accnt->companyName,
                        'streetAddress' => $accnt->streetAddress, 
                        'city' => $accnt->city, 
                        'state' => $accnt->state, 
                        'zipcode' => $accnt->zipcode, 
                        'contacts' => $contacts,
                        'balance' => $balance
                    ];

                    $accountsOpen[] = $accntObject;
                }

                $accountsClosedQuery = \DB::table('accounts')->where('accountStatus','=','2')->get();

                $accountsClosed = array();

                foreach ( $accountsClosedQuery as $accnt ) {
                    $accntObject = array();

                    $contactQuery = Contact::where('accountId','=',$accnt->id)->get();

                    $contacts = array();

                    foreach ( $contactQuery as $contact ) {
                        $contactObject = array();

                        $type = \DB::table('contact_types')->where('id','=',$contact->contactTypeId)->first()->contactType;

                        $contactObject = [
                            'name' => $contact->firstName . ' ' . $contact->lastName,
                            'email' => $contact->email,
                            'phone' => $contact->phone,
                            'type' => $type
                        ];

                        $contacts[] = $contactObject;
                    }

                    $balance = Balance::where('accountId','=',$accnt->id)->first()->balance;

                    $accntObject = [
                        'id' => $accnt->id,
                        'name' => $accnt->companyName,
                        'streetAddress' => $accnt->streetAddress, 
                        'city' => $accnt->city, 
                        'state' => $accnt->state, 
                        'zipcode' => $accnt->zipcode, 
                        'contacts' => $contacts,
                        'balance' => $balance
                    ];

                    $accountsClosed[] = $accntObject;
                }

                $data = [
                    'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
                    'accounts'  => $accountsOpen,
                    'closed'    => $accountsClosed
                ];

                return view('portal_customers', $data);
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalDeleteAccount($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $accntId = $id;
            
                $account = Account::where('id','=',$accntId)->first();

                $account->accountStatus = 2;
                $account->save();

                return Redirect::to('/portal-customers');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalRestoreAccount($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $accntId = $id;
            
                $account = Account::where('id','=',$accntId)->first();

                $account->accountStatus = 1;
                $account->save();

                return Redirect::to('/portal-customers');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalEmployeeTimesheets($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
                $authUserId = \Auth::id();
        
                $authEmployee = Employee::where('userId','=',$authUserId)->first();

                $empId = $id;
                $emp = Employee::where('id','=',$empId)->first();
                $timesheet =  Timesheet::where('empId','=',$empId)->first();

                $data = [
                    'name'      => $authEmployee->firstName . ' ' . $authEmployee->lastName,
                    'id'        => $empId,
                    'emp'       => $emp->firstName . ' ' . $emp->lastName,
                    'rate'      => $emp->hourlyRate,
                    'sunday'    => $timesheet->sunday,
                    'monday'    => $timesheet->monday,
                    'tuesday'   => $timesheet->tuesday,
                    'wednesday' => $timesheet->wednesday,
                    'thursday'  => $timesheet->thursday,
                    'friday'    => $timesheet->friday,
                    'saturday'  => $timesheet->saturday,
                    'total'     => $timesheet->total,
                ];

                return view('portal_emp_timesheet', $data);
                
            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalResetTimesheet($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 ) {
                
                $authUserId = \Auth::id();
        
                $authEmployee = Employee::where('userId','=',$authUserId)->first();

                $empId = $id;
                $timesheet =  Timesheet::where('empId','=',$empId)->first();

                $timesheet->sunday = 0;
                $timesheet->monday = 0;
                $timesheet->tuesday = 0;
                $timesheet->wednesday = 0;
                $timesheet->thursday = 0;
                $timesheet->friday = 0;
                $timesheet->saturday = 0;
                $timesheet->total = 0;

                $timesheet->save();

                return Redirect::to('/portal-emp-timesheets/' . $empId);
                
            } else if ( $userTypeID == 2 ) {
              
                return Redirect::to('/portal-settings');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
    protected function portalEmailBalance($id) {
        
        if ( \Auth::user() ) {
            
            $userTypeID = \Auth::user()->userTypeId;
            
            if ( $userTypeID == 1 || $userTypeID == 2 ) {
                
                $authUserId = \Auth::id();
        
                $authEmployee = Employee::where('userId','=',$authUserId)->first();

                $accountId = $id;

                $account = Account::where('id','=',$accountId)->first();

                $contact = Contact::where('accountId','=',$accountId)->where('contactTypeId','=',1)->first();

                $balance = Balance::where('accountId','=',$accountId)->first()->balance;

                $data = array(
                    'contact' => $contact->firstName . ' ' . $contact->lastName,
                    'id' => $accountId,
                    'name' => $account->companyName,
                    'balance' => $balance,
                );

                $test = "hello";
                Mail::send('email_invoice_balance', $data, function ($message) use($contact){

                    $message->from('jesherart@gmail.com', 'D.C.I. Printing & Graphics, Inc.');

                    $message->to($contact->email, $contact->firstName)->subject('Account Balance');

                });

                return Redirect::to('/portal-invoices');
                
            } else {

                return Redirect::to('/account');

            }
            
        } else {
            
            return Redirect::to('/');
            
        }
        
    }
    
}