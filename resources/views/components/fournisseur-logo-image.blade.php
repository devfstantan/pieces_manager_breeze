@props(['src'])
@if ($src)
    <img class="rounded-full w-10 h-10" src="{{ '/storage/' .  $src }}" alt="Logo fournisseur">
@else
    <img class="rounded-full w-10 h-10" src="{{ '/images/fournisseur-default.webp' }}" alt="Logo fournisseur">
@endif
