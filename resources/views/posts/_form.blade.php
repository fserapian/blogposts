<div class="form-group">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $post->title ?? null) }}" class="form-control">
</div>

<div class="form-group">
    <label for="content">Content</label>
    <input type="text" id="content" name="content" value="{{ old('content', $post->content ?? null) }}"
           class="form-control">
</div>
