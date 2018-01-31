@extends('panelViews::mainTemplate')
@section('page-wrapper')
        
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">{{ \Lang::get('panel::fields.reports') }}</h1>
                    <div class="icon-bg ic-layers"></div>
                    
                    
                </div>
                            
            </div>
            <!-- /.row -->

<link rel="stylesheet" href="{!! asset('css/bootstrap-material-datetimepicker.css') !!}" />

<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>

 <script type="text/javascript" src="{!! asset('js/bootstrap-material-datetimepicker.js') !!}"></script>

<script language="javascript" type="text/javascript">
$(document).ready(function () {
$('#pickup_time1').bootstrapMaterialDatePicker
			({
				date: false,
				shortTime: false,
				format: 'HH:mm'
			});
 $('#pickup_time2').bootstrapMaterialDatePicker
			({
				date: false,
				shortTime: false,
				format: 'HH:mm'
			});
                        $('#pickup_date').datepicker({
                            format: 'yyyy-mm-dd',
                            todayBtn: 'linked',
                            autoclose: true
                        });
                         $('#pickup_date1').datepicker({
                            format: 'yyyy-mm-dd',
                            todayBtn: 'linked',
                            autoclose: true
                        });
                         $('#checked_in').datepicker({
                            format: 'yyyy-mm-dd',
                            todayBtn: 'linked',
                            autoclose: true
                        }); 
 								$('#checked_out').datepicker({
                            format: 'yyyy-mm-dd',
                            todayBtn: 'linked',
                            autoclose: true
                        }); 

});

</script>
<script>
    $(function(){
        var color = ['primary','green','orange','red','purple','green2','blue2','yellow'];
        var pointer = 0;
        $('.panel').each(function(){
            if(pointer > color.length) pointer = 0;
            $(this).addClass('panel-'+color[pointer]);
            $(this).find('.pull-right .add').addClass('panel-'+color[pointer]);
            pointer++;
        })
        // check for update of laravelpanel 
        $.getJSON( "http://api.laravelpanel.com/checkupdate/{{ $version }}", function( data ) {
          if(data.needUpdate){
            $(".update a").text(data.text);
            $(".update").removeClass('hide');
          }
        })
        
    })
</script>
@stop            
