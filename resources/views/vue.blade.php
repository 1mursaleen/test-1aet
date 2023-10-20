<!DOCTYPE html>
<html lang="" class="">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <link rel="icon" href="/logo.svg" />

  <link rel="stylesheet" type="text/css" href="/loader.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <title>RankTracker</title>

  @vite('vue/main.js')
</head>

<body class="font-Inter">
  <noscript>
    <strong>We're sorry but RankTracker doesn't work
      properly without JavaScript enabled. Please enable it to
      continue.</strong>
  </noscript>
  <div id="loading-bg">
    <div class="loading-logo text-center w-10">
      <img src="/logo.svg" alt="Logo" />
    </div>
    <div class="loading">
      <div class="effect-1 effects"></div>
      <div class="effect-2 effects"></div>
      <div class="effect-3 effects"></div>
    </div>
  </div>
  <div id="app" class="h-full"></div>
</body>

</html>
