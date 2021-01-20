{{-- @if ($show === true) --}}
    <span class="badge badge-{{ $type ?? 'success' }}">
        {{ $slot }}
    </span>
{{-- @else
    <h2>Nope</h2>
@endif --}}
