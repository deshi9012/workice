<script src="{{ getAsset('plugins/nestable/jquery.nestable.js') }}"></script>
<script>
$(document).ready(function()
{
    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            axios.post('/todos/reorder', {
                data: list.nestable('serialize')
            })
          .then(function (response) {
            toastr.info( response.data.message , '@langapp('response_status') ');
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
          });
        }
    };

    $('#nestabled').nestable({
        group: 1,
        maxDepth: 2,
    }).on('change', updateOutput);

    // activate Nestable for list 1
    $('#nestable1').nestable({
        group: 1
    });
    
    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    });

    var $expand = false;
    $('#nestable-menu').on('click', function(e)
    {
        if ($expand) {
            $expand = false;
            $('.dd').nestable('expandAll');
        }else {
            $expand = true;
            $('.dd').nestable('collapseAll');
        }
    });

    $('#nestable3').nestable();

});
</script>