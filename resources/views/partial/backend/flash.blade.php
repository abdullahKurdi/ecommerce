@if(session()->has('message'))
<div class="alert alert-{{session()->get('alert-type')}} alert-dismissible fade show" role="alert" id="alert-session">
    {{session()->get('message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
