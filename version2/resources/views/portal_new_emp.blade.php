@extends('portal')

@section('title')
New Employee - Employee Portal | DCI Printing &amp; Graphics, Inc. 
@stop

@section('empName')
<a href="/portal-settings">{{$name}}</a>
@stop

@section('content')
<h2>My Employees</h2>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
</div>

<div id="settingsBox">
    <h3>Add New Employee</h3>
    
    <hr>
    
    <form id="newEmpForm" method="POST" action="portal-new-employee">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>First Name:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="firstName" name="firstName" placeholder="First Name" required/>
            </div>
        </div> 
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Last Name:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Username:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="username" name="username" placeholder="Username" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Password:</p>
            </div>
            <div class="col-lg-8">
                <input type="password" id="password" name="password" placeholder="Password" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Email:</p>
            </div>
            <div class="col-lg-8">
                <input type="email" id="email" name="email" placeholder="Email Address" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Phone:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="phone" name="phone" placeholder="10-digit Phone Number" maxlength="10" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Street Address:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>City:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="city" name="city" placeholder="City" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>State:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="state" name="state" placeholder="State" maxlength="2" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Zipcode:</p>
            </div>
            <div class="col-lg-8">
                <input type="number" id="zipcode" name="zipcode" placeholder="Zipcode" min="00000" max="99999" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>SSN:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="ssn" name="ssn" placeholder="SSN" maxlength="9" />
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Hourly Rate:</p>
            </div>
            <div class="col-lg-8">
                <input type="number" id="hourlyRate" name="hourlyRate" placeholder="Hourly Rate" step="0.01" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Primary Store:</p>
            </div>
            <div class="col-lg-8">
                <select name="primaryStoreId" required>
                    <option value="">Select Store Location</option>
                @foreach ($stores as $store)
                    <option value="{{$store['id']}}">{{$store['location']}}</option>  
                @endforeach
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Employee Type:</p>
            </div>
            <div class="col-lg-8">
                <select name="userTypeId" required>
                    <option value="">Select User Type</option>
                @foreach ($types as $type)
                    @if ( $type['id'] != 3 )
                        <option value="{{$type['id']}}">{{$type['type']}}</option>
                    @endif 
                @endforeach
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <a href="/portal-employees"><input class="portalBtn formBtn" type="button" id="cancelEditEmpBtn" name="cancelEditEmpBtn" value="CANCEL" /></a>
                <input class="portalBtn formBtn" type="submit" id="newEmpBtn" name="newEmpBtn" value="SUBMIT" />
            </div>
        </div>
        
    </form>
    
</div>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
</div>
@stop

@section('activeLink')
<script>
    $(document).ready(function() {
        $('#employees').css('background','white').css('color','#ed008c').css('border-color','#00adef');
    });
</script>
@stop
