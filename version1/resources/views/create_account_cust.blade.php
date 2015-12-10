@extends('main')

@section('title')
Create Account | DCI Printing &amp; Graphics, Inc. 
@stop

@section('content')
    <h2 class="ylw">Create Account</h2>
    <div id="basicPanel" class="create">
        
        <button id="new" class="accntBtns">New Account &amp; Contact</button>
        
        <button id="existing" class="accntBtns">New Contact For Existing Account</button>
        
        <h3 id="choice">Choose an account option...</h3>
        
        <form id="createAccount1" class="createAccnt" method="POST" action="/auth/register">
            
            <input type="text" id="companyName" name="companyName" placeholder="Company Name" required />
            <input type="text" id="streetAddress" name="streetAddress" placeholder="Street Address" required />
            <input type="text" id="city" name="city" placeholder="City" required />
            <input type="text" id="state" name="state" placeholder="State Abbreviation" required />
            <input type="number" id="zipcode" name="zipcode" placeholder="5-Digit Zipcode" required />
            
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required />
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required />
            <input type="email" id="email" name="email" placeholder="Email" required />
            <input type="text" id="phone" name="phone" placeholder="10-Digit Phone Number" required />
            <input type="text" id="username" name="username" placeholder="username" required />
            <input type="password" id="password" name="password" placeholder="password" required />
            <input type="hidden" id="accountStatus" name="accountStatus" value="1">
            <input type="hidden" id="userTypeId" name="userTypeId" value="3">
            <input type="hidden" id="contactTypeId" name="contactTypeId" value="1">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit">Create Account!</button>
        </form>
        
        <form id="createAccount2" class="createAccnt" method="POST" action="/auth/register">
            <input type="number" id="accountId" name="accountId" placeholder="Account ID" required />
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required />
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required />
            <input type="email" id="email" name="email" placeholder="Email" required />
            <input type="text" id="phone" name="phone" placeholder="10-Digit Phone Number" required />
            <input type="text" id="username" name="username" placeholder="username" required />
            <input type="password" id="password" name="password" placeholder="password" required />
            <input type="hidden" id="userTypeId" name="userTypeId" value="3">
            <input type="hidden" id="contactTypeId" name="contactTypeId" value="2">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit">Create Account!</button>
        </form>
    </div>

@stop