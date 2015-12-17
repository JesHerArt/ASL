@extends('main')

@section('title')
My Account | DCI Printing &amp; Graphics, Inc. 
@stop

@section('content')
<div id="basicPanel">
    <h2 id="pwHeading" class="account">Change Password</h2>
    
    <hr>
    
    <form id="updatePw" method="POST" action="/user-credentials">
        
        <input type="hidden" id="contactId" name="contactId" value="{{$contactId}}">
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
                <a href="/account"><input class="portalBtn formBtn" type="button" id="cancelEditEmpBtn" name="cancelEditEmpBtn" value="CANCEL" /></a>
                <input class="portalBtn formBtn" type="submit" id="editEmpBtn" name="editEmpBtn" value="SUBMIT" />
            </div>
        </div>
        
    </form>
</div>
@stop