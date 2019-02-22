@include('layout._head')
<section>
    @include('layout._nav')
    {{--@include('layout._notice')--}}
    @yield('contents')
</section>
@include('layout._foot')