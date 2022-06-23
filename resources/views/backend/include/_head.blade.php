<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/backend/icons/admin-icon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('assets/backend/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
    @yield('custom_css')
</head>