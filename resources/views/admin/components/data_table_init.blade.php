<script src="{{asset('admin/js/lib/datatables-net/datatables.min.js')}}"></script>
<script>    
function IntializeTable(){
$('#data-table').DataTable({        
        processing: true,
        responsive: true,
        serverSide: true,      
        @if(isset($data['order_column']) && isset($data['order_by']))      
        order: [[ {{$data['order_column']}}, "{{$data['order_by']}}" ]],
        @endif
        language: {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
        ajax: '{!! $route !!}',
        columns: [                        
            @foreach($data['columns'] as $key => $val)
                {
                    data: '{{$val['data']}}', 
                    name: '{{$val['name']}}', 
                    orderable: {{$val['orderable'] == 1 ? 'true':'false'}}, 
                    searchable: {{$val['searchable'] == 1 ? 'true':'false'}}
                },
            @endforeach
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
        ],                   
           initComplete: function () {            
            $('.data-table tfoot th').each( function () {                                                                
                var type = $(this).attr("type");
                    var text_field = TextField(type)                    
                    $(this).html(text_field);
                });
            this.api().columns().every( function () {
                var that = this;
                $('.text-field', this.footer() ).on('keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that.search( this.value ).draw();
                    }
                } );
                $('.select-filter', this.footer() ).on('keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that.search( this.value ).draw();
                    }
                });
            });
            $('.data-table-select').select2();
        }        
    });
}
$(document).ready(function(){
    IntializeTable();
});

$("#reload").click(function(){    
    var table = $('#data-table').DataTable(); 
    table.destroy();
    IntializeTable();
});
</script>
@include('admin.components.text_field')