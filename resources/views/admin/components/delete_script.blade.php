<script>
  $(document).on('click',".{{$data['name']}}-delete",function(event){
            var id = $(this).attr('cid');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                $.post("{{route($data['base_route'].'.destroy')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
                 swal("{{$data['panel_name']}} record has been deleted!", {
                    icon: "success",
                    }).then(function(){
                    var table = $('#data-table').DataTable(); 
                            table.ajax.reload( null, false );
                  });
                });
              }
            });
        });
</script>