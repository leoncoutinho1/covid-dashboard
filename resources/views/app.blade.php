<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- <link href="{{ mix('/css/app.css') }}" rel="stylesheet" /> -->
    <script src="{{ mix('/js/app.js') }}" defer></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Painel COVID19</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noticia+Text:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  </head>
  <body>
    @inertia
  </body>
</html>