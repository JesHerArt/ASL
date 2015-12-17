@extends('portal')

@section('title')
Change Password - Employee Portal | DCI Printing &amp; Graphics, Inc. 
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
    <h3>Change Password</h3>
    
    <hr>
    
    <form id="editEmpForm" method="POST" action="/portal-user-credentials">
        
        <input type="hidden" id="empId" name="empId" value="{{$empId}}">
        <input type="hidden" id="userId" name="userId" value="{{$userId}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Old Password:</p>
            </div>
            <div class="col-lg-8">
                <input type="password" id="oldPassword" name="oldPassword" placeholder="Old Password" required/>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>New Password:</p>
            </div>
            <div class="col-lg-8">
                <input type="password" id="newPassword" name="newPassword" placeholder="New Password" required/>
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
