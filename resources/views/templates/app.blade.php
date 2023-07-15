<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @include('templates.layouts.style')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('templates.layouts.sidebar')

            <div class="layout-page">
                @include('templates.layouts.navbar')
                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    @include('templates.layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>

        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    @include('templates.layouts.script')
</body>

</html>