@extends('main')

@section('title')
My Account | DCI Printing &amp; Graphics, Inc. 
@stop

@section('content')
<div id="basicPanel">
    <h2 class="account">Welcome, <span id="usersName">{{$name}}</span> !</h2>
    <h3 class="account">{{$company}}</h3>
    <br/>
    
    <hr>
    
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <br/>
            <h4>Company Details</h4>
            
            <table>
                <tr>
                    <th>Company Name</th>
                    <td>{{$company}}</td>
                </tr>
                <tr>
                    <th>Street Address</th>
                    <td>{{$address1}} {{$address2}}</td>
                </tr>
                <tr>
                    <th>Account Status</th>
                    <td>{{$status}}</td>
                </tr>
            </table>
        </div>
        
        <div class="col-lg-6 col-md-6">
            <br/>
            <h4>Contact Details</h4>
            
            <table>
                <tr>
                    <th>Contact Name</th>
                    <td>{{$name}}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{$username}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$email}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{$phone}}</td>
                </tr>
                <tr>
                    <th>Contact Type</th>
                    <td>{{$contact}}</td>
                </tr>
            </table>
            
            <a href="/user-credentials"><button id="changePw">Change Password</button></a>
            
        </div>
    </div>
    
    <hr>
    <br/>
    <h4>Account Balance</h4>
    <h3 class="account">${{$balance}}</h4>
</div>
@stop