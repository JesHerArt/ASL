@extends('portal')

@section('title')
Weekly Timesheet - Employee Portal | DCI Printing &amp; Graphics, Inc. 
@stop

@section('empName')
<a href="/portal-settings">{{$name}}</a>
@stop

@section('content')
<h2>Weekly Timesheet</h2>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
</div>

<div id="settingsBox">
    
    <h3 id="hoursHeading">Hours Worked</h3>
    
    
    {{$today}}
    
    <hr>
    
    <form id="time" method="POST" action="/portal-timesheet">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div id="timeWrapper">
            <div class="day">
            <h4>S</h4>
            <input class="timeInput" type="number" id="sunday" name="sunday" placeholder="0" value="{{$sun}}" step="0.01" required />
        </div>
        
        <div class="day">
            <h4>M</h4>
            <input class="timeInput" type="number" id="monday" name="monday" placeholder="0" value="{{$mon}}" step="0.01" required />
        </div>
        
        <div class="day">
            <h4>T</h4>
            <input class="timeInput" type="number" id="tuesday" name="tuesday" placeholder="0" value="{{$tues}}" step="0.01" required />
        </div>
        
        <div class="day">
            <h4>W</h4>
            <input class="timeInput" type="number" id="wednesday" name="wednesday" placeholder="0" value="{{$wed}}" step="0.01" required />
        </div>
        
        <div class="day">
            <h4>TH</h4>
            <input class="timeInput" type="number" id="thursday" name="thursday" placeholder="0" value="{{$thurs}}" step="0.01" required />
        </div>
        
        <div class="day">
            <h4>F</h4>
            <input class="timeInput" type="number" id="friday" name="friday" placeholder="0" value="{{$fri}}" step="0.01" required />
        </div>
        
        <div class="day">
            <h4>S</h4>
            <input class="timeInput" type="number" id="saturday" name="saturday" placeholder="0" value="{{$sat}}" step="0.01" required />
        </div>
        </div>
    
    <hr>
    <div id="timeResults" class="row">
        <div class="col-lg-6">
            <h4 id="totalHeading">Week Total: <span id="wkTotal">{{$total}}</span></h4>
        </div>
        
        <div class="col-lg-6 rightSide">
            <button class="portalBtn">Save</button>
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
        $('#timesheet').css('background','white').css('color','#ed008c').css('border-color','#00adef');
    });
</script>
@stop
