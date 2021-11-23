<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html>
 <head>
   <title>404 Page Not Found</title>
   <style>
   body{
     width: 99%;
     height: 100%;
     background-color: ghostwhite;
     color: white;
     font-family: sans-serif;
   }
   div {
     position: absolute;
     width: 400px;
     height: 300px;
     z-index: 15;
     top: 45%;
     left: 50%;
     margin: -100px 0 0 -200px;
     text-align: center;
   }
   h1,h2{
     text-align: center;
   }
   h1{
     font-size: 100px;
     margin-bottom: 10px;
     
     color: #555;
     font-family: sans-serif;
   }
   h2{
   	 font-size: 25px;
     margin-bottom: 40px;
     color: #555;
   }
   a{
     margin-top:10px;
     text-decoration: none;
     padding: 10px 25px;
     color: #888;
     margin-top: 20px;
   }
   </style>
 </head>
 <body>
   <div>
     <h1>Oops !</h1>
     <h2>[404] This Page Doesn't Exist</h2>
     <a href="#" onclick="history.go(-1)">Back to home</a>
   </div>
 </body>
</html>	