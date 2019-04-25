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
        #order {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #order td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #order tr:nth-child(even){background-color: #f2f2f2;}

        #order th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #000;
            color: white;
        }
    </style>  
    <div class="header">
        <a style="display: block;width: 220px;margin: 0 auto;" href="{{url('/')}}" target="_blank">
            <img style="width: 201px;margin: 0 auto;" src="{{ asset('img/aldarull-title_white.png') }}">
        </a>
    </div>
    <div class="main" style="text-align: center;width: 60%;margin: 0 auto;">
        <h1>Bon dia/tarda, {{$name}}</h1>
        <p>La seva comanda ja està preparada</p> 
        @if($codeSeg=='')
        La podras recollir en el nostre proper concert
        @else
        En uns dies ho rebrás a casa teva.
        <p>
            Pots seguir l'enviament amb el següent codi:
            <br/>
            {{$codeSeg}}            
        </p>
        @endif
        <br/>

        Moltes gracies.

        Grup Aldarull
    </div>
    <div class="footer" align="center">
    </div>
</body>
</html>