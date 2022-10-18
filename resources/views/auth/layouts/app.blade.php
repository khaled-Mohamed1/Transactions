<!DOCTYPE html>
<html lang="en">

{{-- Head Before AUTH--}}
@include('auth.includes.head')

<body class="bg-gradient-primary" style="font-family: Cairo,serif; direction: rtl;">

    <div class="container" id="wrapper">

        {{-- Content Goes Here FOR Before AUTH --}}
        @yield('content')

    </div>

    {{-- Scripts Before AUTH --}}
    @include('auth.includes.scripts')

</body>

</html>
