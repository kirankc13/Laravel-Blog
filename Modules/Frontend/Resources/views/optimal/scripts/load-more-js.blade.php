<script>
    $(document).on('click','#load-more-posts',function(){
        $('.more-posts-loader').show();
        $.ajax({
            type: "GET",
            url: $(this).attr('data-next-page'),
            success: function(data)
            {
                $('.pagination_infinite_style_cat').append(data.posts);
                if(data.next_page === null){
                    $('#load-more-posts').remove();
                }else{
                    $('#load-more-posts').attr('data-next-page',data.next_page);
                }
                $('.more-posts-loader').hide();
                $('.jl-load-text').show();
            },
            error: function(data)
            {
                $('.more-posts-loader').hide();
            }
        });
    });
</script>