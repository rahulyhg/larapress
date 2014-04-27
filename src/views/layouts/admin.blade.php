<!DOCTYPE html>

<html>
    <head>
        {{HTML::style('packages/larapress/larapress/styles.css')}}
    </head>
    
    <body>
        <div id="page">
        <div id="sidebar">
            @foreach($packages as $package)
            {{$package["name"]}}<br><br>
            @endforeach
        </div>
        
        <div id="main-content">
            @yield('content')
        </div>
        </div>
        
    </body>
</html>