@extends('portal')

@section('title')
Edit Employee - Employee Portal | DCI Printing &amp; Graphics, Inc. 
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
    <h3>Editing Employee #{{$employee['id']}}</h3>
    
    <hr>
    
    <form id="editEmpForm" method="POST" action="/portal-edit-employee">
        
        <input type="hidden" id="userId" name="userId" value="{{$employee['userId']}}">
        <input type="hidden" id="empId" name="empId" value="{{$employee['id']}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>First Name:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="firstName" name="firstName" placeholder="First Name" value="{{$employee['fName']}}" required/>
            </div>
        </div> 
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Last Name:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="{{$employee['lName']}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Email:</p>
            </div>
            <div class="col-lg-8">
                <input type="email" id="email" name="email" placeholder="Email Address" value="{{$employee['email']}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Phone:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="phone" name="phone" placeholder="10-digit Phone Number" value="{{$employee['phone']}}" maxlength="10" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Street Address:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" value="{{$employee['streetAddress']}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>City:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="city" name="city" placeholder="City" value="{{$employee['city']}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>State:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="state" name="state" placeholder="State" value="{{$employee['state']}}" maxlength="2" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Zipcode:</p>
            </div>
            <div class="col-lg-8">
                <input type="number" id="zipcode" name="zipcode" placeholder="Zipcode" value="{{$employee['zipcode']}}" min="00000" max="99999" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>SSN:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="ssn" name="ssn" placeholder="SSN" value="{{$employee['ssn']}}" maxlength="9" />
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Hourly Rate:</p>
            </div>
            <div class="col-lg-8">
                <input type="number" id="rate" name="rate" placeholder="Hourly Rate" value="{{$employee['rate']}}" step="0.01" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Primary Store:</p>
            </div>
            <div class="col-lg-8">
                <select name="store">
                    <option value="">Select Store Location</option>
                @foreach ($stores as $store)
                    @if ( $employee['store'] == $store['id'] )
                    <option value="{{$store['id']}}" selected="selected">{{$store['location']}}</option>
                    @else
                    <option value="{{$store['id']}}">{{$store['location']}}</option>
                    @endif    
                @endforeach
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Employee Type:</p>
            </div>
            <div class="col-lg-8">
                <select name="userType">
                    <option value="">Select User Type</option>
                @foreach ($types as $type)
                    @if ( $type['id'] != 3 )
                        @if ( $employee['type'] == $type['id'] )
                        <option value="{{$type['id']}}" selected="selected">{{$type['type']}}</option>
                        @else
                        <option value="{{$type['id']}}">{{$type['type']}}</option>
                        @endif  
                    @endif 
                @endforeach
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <a href="/portal-employees"><input class="portalBtn formBtn" type="button" id="cancelEditEmpBtn" name="cancelEditEmpBtn" value="CANCEL" /></a>
                <input class="portalBtn formBtn" type="submit" id="editEmpBtn" name="editEmpBtn" value="SUBMIT" />
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
