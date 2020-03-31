@if ($errors->any())
    <ul style="color: red">
        @foreach ($errors->all() as $error)
            <li>
                {{$error}}
            </li>
        @endfore ach
    </ul>
@endif
