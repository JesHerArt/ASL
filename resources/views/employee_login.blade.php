@extends('main')

@section('title')
Employee Login | DCI Printing &amp; Graphics, Inc. 
@stop

@section('content')
    <h2 class="ylw">Employee Login</h2>
    <div id="loginPanel">
        <form id="empLoginForm" method="POST" action="e-auth/login">
            <input type="text" id="username" name="username" placeholder="username" required />
            <input type="password" id="password" name="password" placeholder="password" required />
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit">Login to Portal!</button>
        </form>
    </div>
@if ($errors)
    <div class="probs">
      @foreach ($errors->all() as $error)
        <p class="prob">{{ $error }}</p>
      @endforeach
    </div> <!-- .login-probs -->
    @endif
@stop