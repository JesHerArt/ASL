@extends('portal')

@section('title')
Edit My Settings - Employee Portal | DCI Printing &amp; Graphics, Inc. 
@stop

@section('empName')
<a href="/portal-settings">{{$name}}</a>
@stop

@section('content')
<h2>My Settings</h2>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
</div>

<div id="settingsBox">
    <h3>Edit My Settings</h3>
    
    <hr>
    
    <form id="editEmpForm" method="POST" action="/portal-edit-settings">
        
        <input type="hidden" id="empId" name="empId" value="{{$empId}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>First Name:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="firstName" name="firstName" placeholder="First Name" value="{{$firstName}}" required/>
            </div>
        </div> 
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Last Name:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" value="{{$lastName}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Email:</p>
            </div>
            <div class="col-lg-8">
                <input type="email" id="email" name="email" placeholder="Email Address" value="{{$email}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Phone:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="phone" name="phone" placeholder="10-digit Phone Number" value="{{$phone}}" maxlength="10" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Street Address:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" value="{{$streetAddress}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>City:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="city" name="city" placeholder="City" value="{{$city}}" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>State:</p>
            </div>
            <div class="col-lg-8">
                <input type="text" id="state" name="state" placeholder="State" value="{{$state}}" maxlength="2" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Zipcode:</p>
            </div>
            <div class="col-lg-8">
                <input type="number" id="zipcode" name="zipcode" placeholder="Zipcode" value="{{$zipcode}}" min="00000" max="99999" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <a href="/portal-settings"><input class="portalBtn formBtn" type="button" id="cancelEditEmpBtn" name="cancelEditEmpBtn" value="CANCEL" /></a>
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
        $('#settings').css('background','white').css('color','#ed008c').css('border-color','#00adef');
    });
</script>
@stop
