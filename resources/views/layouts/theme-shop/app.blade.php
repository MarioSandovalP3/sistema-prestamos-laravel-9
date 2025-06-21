
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
         <link rel="icon" type="image/png" href="{{asset('storage/companies/icons/' . $company->ico)}}"/>
         {!! SEOMeta::generate() !!}
         {!! OpenGraph::generate() !!}
         {!! Twitter::generate() !!}
         {!! JsonLd::generate() !!}
         <!-- BEGIN GLOBAL MANDATORY STYLES -->
         @include('layouts.theme-shop.styles')
         <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
   </head>
   <body>
      @include('layouts.theme-shop.header')
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <div id="content" class="main-content">
            <div class="layout-px-spacing ">
               @yield('content')
            </div>
            
         </div>
      </div>
       @include('layouts.theme-shop.footer')
      @include('layouts.theme-shop.scripts')
   </body>
</html>