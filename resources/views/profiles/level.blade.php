<br />
<a>
    ({{ $profileUser->reputation }} XP)
    @if($profileUser->reputation < 32)
        Lv0 <i class="fas fa-meteor"></i>
    @elseif($profileUser->reputation < 256)
        Lv1 <i class="fas fa-star-half-alt"></i>
    @elseif($profileUser->reputation < 1024)
        Lv2 <i class="fas fa-star"></i>
    @elseif($profileUser->reputation < 4096)
        Lv3 <i class="fas fa-star-of-david"></i>
    @elseif($profileUser->reputation < 16384)
        Lv4 <i class="fas fa-moon"></i>
    @elseif($profileUser->reputation < 65536)
        Lv5 <i class="fas fa-star-and-crescent"></i>
    @elseif($profileUser->reputation < 131072)
        Lv6 <i class="far fa-sun"></i>
    @endif
</a>
