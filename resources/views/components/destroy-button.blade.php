@props(['action'])
<form action="{{$action}}" method="post">
    @csrf
    @method('delete')
    <x-danger-button> {{__('Supprimer')}}</x-danger-button>
</form>
