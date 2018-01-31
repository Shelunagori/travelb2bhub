@extends('panelViews::mainTemplate')


@section('page-wrapper')

    @if ($helper_message)
	<div>&nbsp;</div>
	<div class="alert alert-info">
		<h3 class="help-title">{{ trans('rapyd::rapyd.help') }}</h3>
		{{ $helper_message }}
	</div>
	
    @endif

    <p>
    
        {!! $edit !!}
       
    </p>
  
  
   <style>
#fg_country,#fg_zone,#fg_city,#fg_pincode{display:none; }
</style>
   
  	
    <script type="text/javascript" src="{!! asset('js/form.js') !!}"></script>
   
@stop
