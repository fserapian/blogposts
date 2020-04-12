<div class="card mb-3" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-subtitle text-muted">
            {{ $subtitle }}</p>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($items as $item)
        <li class="list-group-item">
            {{ $item }}
        </li>
        @endforeach
    </ul>
</div>