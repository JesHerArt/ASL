@extends('main')

@section('title')
Customer Login | DCI Printing &amp; Graphics, Inc. 
@stop

@section('content')
    <h2 class="mag">Customer Account Login</h2>
    <div id="loginPanel">
        <form id="custLoginForm">
            <input type="email" id="custEmail" name="custEmail" placeholder="email address" required />
            <input type="password" id="custPass" name="custPass" placeholder="password" required />
            <button type="submit">Login to my account!</button>
        </form>
    </div>
@stop