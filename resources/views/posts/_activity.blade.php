<div class="card mb-3" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Most Commented</h5>
        <p class="card-subtitle text-muted">
            What people are talking about
        </p>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($mostCommented as $post)
            <li class="list-group-item">
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Active Users</h5>
        <p class="card-subtitle text-muted">Users with the most posts</p>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($mostActive as $user)
            <li class="list-group-item">
                <span>{{ $user->name }}<span> <small>({{ $user->blog_posts_count }} posts)</small>
            </li>
        @endforeach
    </ul>
</div>

{{-- @component('components.card', ['title' => 'Most Active'])
    @slot('subtitle')
        Users who are most active
    @endslot
    @slot('items', collect($mostActive)->pluck('name'))
@endcomponent --}}

{{-- <div class="card mb-3" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Most Active Last Month</h5>
        <p class="card-subtitle text-muted">
            Most active users last month</p>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($mostActiveLastMonth as $post)
        <li class="list-group-item">
            <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
        </li>
        @endforeach
    </ul>
</div> --}}