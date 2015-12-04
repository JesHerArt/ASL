@extends('portal')

@section('title')
Employee Portal - Settings | DCI Printing &amp; Graphics, Inc. 
@stop

@section('extraLink')
<div id="employees" class="menuBtn tooltipColor" data-toggle="tooltip" data-placement="right" title="Employee Manger">
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
</div>
@stop

@section('empName')
<a href="/portal-settings">Name Here</a>
@stop

@section('content')
    page content goes here
@stop

@section('activeLink')
something

    <script>
        
        $(document).ready(function() {
    console.log("print");
    
    $('#settings').css('background','white').css('color','#ed008c').css('border-color','#00adef');

});</script>
@stop
