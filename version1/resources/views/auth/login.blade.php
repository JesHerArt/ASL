@extends('main')

@section('title')
Login | DCI Printing &amp; Graphics, Inc. 
@stop

@section('content')
    <h2 class="ylw">Account Login</h2>
    <div id="loginPanel">
        
        <form id="empLoginForm" method="POST">
            <input type="text" id="username" name="username" placeholder="username" required />
            <input type="password" id="password" name="password" placeholder="password" required />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit">Login!</button>
        </form>
    </div>
@stop