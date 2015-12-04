@extends('main')

@section('title')
Employee Login | DCI Printing &amp; Graphics, Inc. 
@stop

@section('content')
    <h2 class="ylw">Employee Login</h2>
    <div id="loginPanel">
        <form id="empLoginForm">
            <input type="text" id="empUsername" name="empUsername" placeholder="username" required />
            <input type="password" id="empPass" name="empPass" placeholder="password" required />
            <button type="submit">Login to Portal!</button>
        </form>
    </div>
@stop