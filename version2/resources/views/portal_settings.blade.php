@extends('portal')

@section('title')
Settings - Employee Portal | DCI Printing &amp; Graphics, Inc. 
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
    <h3>{{$name}}</h3>
    <p id="empType">{{$type}}</p>
    
    <hr>
    
    <table id="personalInfo">
        <tr>
            <th>Address</th>
            <td>{{$address1}} {{$address2}}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{$phone}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$email}}</td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{$username}}</td>
        </tr>
        <tr>
            <th>Primary Store</th>
            <td>{{$store}}</td>
        </tr>
        <tr>
            <th>Hourly Rate</th>
            <td>${{$rate}}</td>
        </tr>
    </table>
    
    <hr>
    
    <a href="/portal-edit-settings"><button class="portalBtn">Update My Information</button></a> &nbsp; &nbsp; <a href="/portal-user-credentials"><button class="portalBtn">Change Password</button></a>
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
