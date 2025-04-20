@if ($image)
    <img src="{{ asset('storage/' . $image) }}"
         width="50"
         height="50"
         style="object-fit: cover; border-radius: 6px;">
@else
    <span class="text-gray-400 text-sm">No Image</span>
@endif
