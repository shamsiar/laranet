@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="w-4/12 bg-white p-6 rounded-lg">

                @yield('auth.login')
            </div>
            <div class="w-4/12 bg-white p-6 rounded-lg">

                @yield('auth.register')
            </div>
        </div>
    </div>
@endsection
