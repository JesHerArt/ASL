@extends('main')

@section('title')
DCI Printing &amp; Graphics, Inc.
@stop

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
     
        <div class="carousel-inner" role="listbox">
            
            <div class="item active">
                <img class="first-slide" src="images/outer_store_front.jpg" alt="">
            </div>
            
            <div class="item">
                <img class="second-slide" src="images/store_front.jpg" alt="">
            </div>
            
            <div class="item">
                <img class="third-slide" src="images/plotters.jpg" alt="">
            </div>
        </div>
      
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        </a>
    </div>
    
    <div class="row services">
        <div class="servicePanel">
            <h2 class="ylw">Printing<br/>&amp; Copying</h2>
            <div class="card">
                <p>Specialized in wide/large format printing, we are able to print all your plans/blueprints from 12x18 up to 36x48. We also offer custom sizes for your convenience.</p>
            </div>
        </div>
        
        <div class="servicePanel">
            <h2 class="mag">Digital Blueprint<br/>Services</h2>
            <div class="card">
                <p>Need to digitally archive a project?  We can take that room-full of old drawings and turn it in to an organized CD or DVD.</p>
            </div>
        </div>
        
        <div class="servicePanel">
            <h2 class="cyn">CAD Drafting<br/>&amp; Blueprinting</h2>
            <div class="card">
                <p>We can draw your CAD files and offer Engineering Consulting Services.</p>
            </div>
        </div>
        
        <div class="servicePanel">
            <h2 class="blk">Printer &amp;<br/>Plotter Supplies</h2>
            <div class="card">
                <p>For media, blueprinting supplies and architectural drafting supplies are available for your in-house needs at our location. We offer same or next day delivery on in-stock items.</p>
            </div>
        </div>
    </div>
@stop