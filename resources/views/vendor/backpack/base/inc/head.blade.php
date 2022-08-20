    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  
  
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">



    @if (config('backpack.base.meta_robots_content'))<meta name="robots" content="{{ config('backpack.base.meta_robots_content', 'noindex, nofollow') }}"> @endif

    <meta name="csrf-token" content="{{ csrf_token() }}" /> {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <title>{{ isset($title) ? $title.' :: '.config('backpack.base.project_name') : config('backpack.base.project_name') }}</title>

    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">

    @yield('before_styles')
    @stack('before_styles')
    
    @if (config('backpack.base.styles') && count(config('backpack.base.styles')))
        @foreach (config('backpack.base.styles') as $path)
        <link rel="stylesheet" type="text/css" href="{{ asset($path).'?v='.config('backpack.base.cachebusting_string') }}">
        @endforeach
    @endif

    @if (config('backpack.base.mix_styles') && count(config('backpack.base.mix_styles')))
        @foreach (config('backpack.base.mix_styles') as $path => $manifest)
        <link rel="stylesheet" type="text/css" href="{{ mix($path, $manifest) }}">
        @endforeach
    @endif

    @yield('after_styles')
    @stack('after_styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->