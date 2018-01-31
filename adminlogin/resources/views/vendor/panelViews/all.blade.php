@extends('panelViews::mainTemplate')
@section('page-wrapper')


{!! $filter !!}

<br><br>
<?php if($current_entity=="member") { ?>
<a href="javascript:void();" mydata ="{!! url('panel/'.$current_entity.'/export/excel') !!}" class="btn btn-info exportmember">{!! \Lang::get('panel::fields.exportAsExcel') !!}</a>

<script>
$(document).ready(function () {
	$('.exportmember').click(function () {
		
		name = $('#name').val()
		email = $('#email').val()
		entity_type = $('input[name=entity_type]:checked').val()
		
		entry = $('input[name=entry]:checked').val()
		link = $(this).attr("mydata")
		
		link =  link + '?name='+name+'&email='+email+'&entity_type='+entity_type+'&entry='+entry;
		
		window.location.href= link
		
	})
	
	$('.fullpaid').click(function () {
		
		name = $('#name').val()
		email = $('#email').val()
		hotel = $('#hotel').val()
		table = $('#table_no').val()
		entry = $('input[name=entry]:checked').val()
		link = $(this).attr("mydata")
		
		link =  link + '?link=fullpaid&name='+name+'&email='+email+'&hotel='+hotel+'&table='+table+'&entry='+entry;
		
		window.location.href= link
		
	})
	
});
</script>
<?php } else if($current_entity=="payment") { ?>
<style>
.pull-right{ display:none; }
</style>

<a href="javascript:void();" mydata ="{!! url('panel/'.$current_entity.'/export/excel') !!}" class="btn btn-info exportpayment">{!! \Lang::get('panel::fields.exportAsExcel') !!}</a>
@if ($adminstatus=="yes")
<a href="javascript:void();" mydata ="{!! url('panel/'.$current_entity.'/export/excel') !!}" class="btn btn-info exportpaymentelixir"> Export online payment</a>
@endif
<script>
$(document).ready(function () {
	$('.exportpayment').click(function () {
		
		member_name = $('#member_name').val()
		member_email = $('#member_email').val()
		status = $('#status').val()
		payfrom = $('input[name=payfrom]:checked').val()
		link = $(this).attr("mydata")
		
		link =  link + '?member_name='+member_name+'&member_email='+member_email+'&status='+status+'&payfrom='+payfrom;
		
		window.location.href= link
		
	})
$('.exportpaymentelixir').click(function () {
		
		member_name = $('#member_name').val()
		member_email = $('#member_email').val()
		status = $('#status').val()
payfrom = $('input[name=payfrom]:checked').val()
		
		link = $(this).attr("mydata")
		
		link =  link + '?link=exporteli&member_name='+member_name+'&member_email='+member_email+'&status='+status+'&payfrom='+payfrom;
		
		window.location.href= link
		
	})	
});
</script>

<?php
 }else if($current_entity=="cities") {?>
<a href="{!! url('panel/'.$current_entity.'/export/excel') !!}" class="btn btn-info">{!! \Lang::get('panel::fields.exportAsExcel') !!}</a>
<a href="#import_modal" data-toggle="modal" class="btn btn-info">{!! \Lang::get('panel::fields.importData') !!}</a>
<?php }else { ?>
<a href="{!! url('panel/'.$current_entity.'/export/excel') !!}" class="btn btn-info">{!! \Lang::get('panel::fields.exportAsExcel') !!}</a>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="import_modal" tabindex="-1" role="dialog" aria-labelledby="import_modal_label" aria-hidden="true">
	<div class="modal-dialog">
	        <div class="modal-content">
	                <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="import_modal_label">{!! \Lang::get('panel::fields.importData') !!}</h4>
                        </div>
			<form method="post" action="{!! url('panel/'.$current_entity.'/import') !!}" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	                        <div class="modal-body">
					<div><input type="file" name="import_file" /></div>
					<br />
					<div>
						<input type="radio" name="status" id="status_1" value="1" checked="checked" />&nbsp;
						<label for="status_1">{!! \Lang::get('panel::fields.deletePreviousData') !!}</label><br />
						<input type="radio" name="status" id="status_2" value="2" />&nbsp;
						<label for="status_2">{!! \Lang::get('panel::fields.keepOverwriteData') !!}</label><br />
						<input type="radio" name="status" id="status_3" value="3" />&nbsp;
						<label for="status_3">{!! \Lang::get('panel::fields.keepNotOverwriteData') !!}</label><br />
					</div>
                                </div>
                                <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">{!! \Lang::get('panel::fields.close') !!}</button>
                                            <button type="submit" class="btn btn-primary">{!! \Lang::get('panel::fields.importData') !!}</button>
                                </div>
			</form>
		</div>
	</div>
</div>

@if ($import_message)
	<div>&nbsp;</div>
	<div class="alert alert-success">{{ $import_message }}</div>
@endif

{!! $grid !!}

@stop   
