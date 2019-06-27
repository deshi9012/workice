<script>
    var pageNumber = 1;
    var ajaxActive = true;
    axios.interceptors.request.use((config) => {
        $("#ajaxData").after($("<span class='loading text-center'><i class='fas fa-sync-alt fa-spin'></i> Loading...</span>").fadeIn('slow')).data("loading", true);
        return config;
    });

  function loadData() {
    axios.get("/api/v1/contacts?page=" +pageNumber+"&json=false", {
                "page": pageNumber,
                "json": false
            })
          .then(function (response) {
            pageNumber +=1;
            var results = $("#ajaxData");
            $(".loading").fadeOut('fast', function() {
                $(this).remove();
            });
            var data = $(response.data);
            data.hide();
            results.append(data);
            data.fadeIn();
            results.removeData("loading");
            if(response.data === ""){
              ajaxActive = false;
            }
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
        });
};

$(function() {
    loadData();
    $(document.body).on('touchmove', onScroll);
    $(".scrollpane").on('scroll', onScroll); 
    function onScroll(){ 
        var $this = $(this);
        var $results = $("#ajaxData");
        if (!$results.data("loading") && ajaxActive) {
          if ($this.scrollTop() +  $this.innerHeight()  >  this.scrollHeight - 100 ) {
                loadData();
          }            
        }
    }

});
  </script>