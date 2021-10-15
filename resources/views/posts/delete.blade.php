<div id="popup">
    <div>
        <i class="far fa-trash-alt"></i>
        <h3>Are you sure?</h3>
        <p class="text-dark">This action cannot be undone.</p>
        <div>
            <input type="submit" class="btn btn-dark" value="Cancel">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Delete">
            </form>
        </div>
    </div>
    <script>
        $('#popup input[value="Cancel"]').on('click', () => $('#popup').remove());
    </script>
</div>
