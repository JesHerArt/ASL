<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Employee;
use App\Account;
use App\Contact;
use App\Balance;
use App\Timesheet;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    protected $username = 'username';
    protected $redirectPath = "/auth/login";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'username'      => $data['username'],
            'password'      => bcrypt($data['password']),
            'created_at'    => gmdate('Y-m-d H:i:s'),
            'updated_at'    => gmdate('Y-m-d H:i:s'),
            'userTypeId'    => $data['userTypeId']
        ]);
        
        $userTypeId = $newUser->userTypeId;
        
        if ( $userTypeId == 1 || $userTypeId == 2) {
            
            $newEmployee = Employee::create([ 
                'userId'        => $newUser->id,
                'firstName'     => $data['firstName'],
                'lastName'      => $data['lastName'],
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'streetAddress' => $data['streetAddress'],
                'city'          => $data['city'],
                'state'         => $data['state'],
                'zipcode'       => $data['zipcode'],
                'ssn'           => $data['ssn'],
                'hourlyRate'    => $data['hourlyRate'],
                'primaryStoreId' => $data['primaryStoreId'],
                'created_at'    => gmdate('Y-m-d H:i:s'),
            ]);
            
            $newTimesheet = Timesheet::create([
                'userId'    => $newUser->id,
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
        
        if ( $userTypeId == 3 ) {
            
            if( array_key_exists('accountId', $data) ) {
                
                $newContact = Contact::create([
                    'userId'        => $newUser->id,
                    'accountId'     => $data['accountId'],
                    'firstName'     => $data['firstName'],
                    'lastName'      => $data['lastName'],
                    'email'         => $data['email'],
                    'phone'         => $data['phone'],
                    'contactTypeId' => $data['contactTypeId']
                ]);
                
            } else {
                
                $newAccount = Account::create([
                    'companyName'   => $data['companyName'],
                    'streetAddress' => $data['streetAddress'],
                    'city'          => $data['city'],
                    'state'         => $data['state'],
                    'zipcode'       => $data['zipcode'],
                    'accountStatus' => $data['accountStatus'],
                ]);
                
                $accntId = $newAccount->id;
                
                $newContant = Contact::create([
                    'empId'    => $newEmployee->id,
                    'accountId'     => $accntId,
                    'firstName'     => $data['firstName'],
                    'lastName'      => $data['lastName'],
                    'email'         => $data['email'],
                    'phone'         => $data['phone'],
                    'contactTypeId' => $data['contactTypeId']
                ]);
                
                $newBalance = Balance::create([
                    'accountId' => $accntId,
                    'balance' => 0.00
                ]);
                
            }
            
        }
        
        return $newUser;
    }
}
