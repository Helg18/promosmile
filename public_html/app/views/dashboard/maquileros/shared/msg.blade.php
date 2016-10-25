@if(Session::has('msg'))
<div class="alert alert-{{ Session::get('class') }}">
  <button type="button" class="close" data-dismiss="alert">
    <i class="icon-remove"></i>
  </button>
  {{ Session::get('msg')}}
  <br/>
</div>
@endif
