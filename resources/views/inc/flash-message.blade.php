@if (session('action_success'))
    <div class="flash-message success">
        <i class="fas fa-check-circle"></i>
        <div>
            <h4>Success!</h4>
            <p>{{ session('action_success') }}</p>
        </div>
        <script>
            setTimeout(() => {
                $('flash-message').remove();
            }, 4000);
        </script>
    </div>
@elseif (session('action_error'))
    <div class="flash-message error">
        <i class="fas fa-exclamation-circle"></i>
        <div>
            <h4>Oops!</h4>
            <p>{{ session('action_error') }}</p>
        </div>
        <script>
            setTimeout(() => {
                $('flash-message').remove();
            }, 4000);
        </script>
    </div>
@endif