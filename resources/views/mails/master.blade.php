<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <style>
        body{
            padding:0px;
            margin:0px;
            font-family: 'verdana',sans-serif;
        }
        .header{
            width: 100%;
            height:190px;
            background-color:#000;
        }
        .footer {
            margin-top:20px;
            width: 100%;
            height:70px;
            background-color:#000;
        }
        @yield('css')
    </style>    
    <div class="header">
        <a style="display: block;width: 220px;margin: 0 auto;" href="http://aldarull.local" target="_blank">
            <img style="width: 201px;margin: 0 auto;" src="http://aldarull.local/img/logo-buda.png">
        </a>
    </div>
    <div class="main" style="text-align: center;width: 60%;margin: 0 auto;">
        @yield('content')
    </div>
    <div class="footer" align="center">
    </div>

</body>
</html>