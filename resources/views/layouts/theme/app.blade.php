<?php 
   $user = DB::table("users")
       ->select("users.name","users.image")
       ->where("users.id", Auth::id())
       ->first();
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ $user ? $user->name : 'Acceso' }}</title>
      @if($user && $user->image)
         <link rel="icon" type="image/png" href="{{ asset('storage/users/'. $user->image) }}"/>
      @else
         <link rel="icon" type="image/png" href="{{ asset('storage/noimguser.png') }}"/>
      @endif
  
      <!-- BEGIN GLOBAL MANDATORY STYLES -->
      @include('layouts.theme.styles')
      <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
   </head>
   <body class="dashboard-analytics">
      <!-- BEGIN LOADER -->
      <div id="load_screen">
         <div class="loader">
            <div class="loader-content">
               <div class="spinner-grow align-self-center"></div>
            </div>
         </div>
      </div>
      <!--  END LOADER -->
      <!--  BEGIN NAVBAR  -->
      @include('layouts.theme.header')
      <!--  END NAVBAR  -->
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('layouts.theme.sidebar')
         <!--  END SIDEBAR  -->
         <!--  BEGIN CONTENT AREA  -->
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               @yield('content')
            </div>
           
         </div>
         
         <!--  END CONTENT AREA  -->
      </div>
      
      <!-- END MAIN CONTAINER -->
      <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
      @include('layouts.theme.scripts')
      <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
   </body>
</html>
