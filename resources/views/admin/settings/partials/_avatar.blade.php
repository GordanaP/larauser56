<div id="myAvatar" class="text-center mb-12">
    <img src="{{ asset(setAvatar($user)) }}" alt="" class="image img-responsive rounded-circle">
</div>

<a href="#" id="editAvatar" data-user="{{ Auth::user()->slug }}">
    Change
</a>