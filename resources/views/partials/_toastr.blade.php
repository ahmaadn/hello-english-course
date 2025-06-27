@if (Session::get('failed') || Session::get('error'))
    <script>toastr.error("{{ Session::get('failed') || Session::get('error') }}")</script>
@endif


@if (Session::get('success'))
    <script>toastr.success("{{ Session::get('success') }}")</script>
@endif
