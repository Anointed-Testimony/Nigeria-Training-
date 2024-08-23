<div id="swap-modal">
    @if ($upload->where('featured', 0)->count() == 0)
        <div class="swap-text">
            <div class="swap-divider">
                <i onclick="closeSwapText()" class="fa-solid fa-xmark"></i>
                <hr>
            </div>
            <h1>You do not have any other course to swap with</h1>
        </div>
    @else
        <form method="POST" action="{{ route('swap') }}" class="swap-container">
            @csrf
            <div class="swap-divider">
                <i onclick="closeSwapText()" class="fa-solid fa-xmark"></i>
                <hr>
            </div>
            @foreach ($upload->where('featured', 0) as $uploads)
                <label onclick="showButton()" data-type="{{ $uploads->upload_type }}" class="events_select" for="select_{{ $uploads->slug_url }}">
                    <div class="your_events_text">
                        <p>{{ $uploads->title }}</p>
                        <input type="radio" name="swap_upload_id" data-id="{{ $uploads->id }}" value="{{ $uploads->id }}" id="select_{{ $uploads->slug_url }}">
                    </div>
                    <div class="your_events_image_container">
                        <img src="{{ asset("/images/$uploads->featured_image") }}" alt="">
                    </div>
                </label>
            @endforeach
            <input type="hidden" id="current_upload_id" name="current_upload_id">
            <button type="submit" class="feature_proceed">Swap</button>
        </form>
    @endif
</div>


<script>
    function openSwap(uploadId){
        document.getElementById('swap-modal').style.display = 'block';
        document.getElementById('current_upload_id').value = uploadId;
        console.log(document.getElementById('current_upload_id').value)
    }
</script>