
function ajaxReaquires(){
      jQuery.ajax({
        url:AcademyAjax.ajax_url,
        method:'POST',
        data:{
          action:"academy_ajax_get_posts",
          per_page:4,
          _ajax_nonce:AcademyAjax.ajax_nonce
        },
        success:function(response){
          if(Array.isArray(response)){
            let html='<ul>';
            response.forEach(function(item){
              html += '<li>'+item.post_title+'</li>'; 
            });
            html+='</ul>';

           jQuery('.wedevs-ajax-page').append(html);
          }
        }
    });
}

    jQuery(document).ready(function($){

      $('.wedevs-ajax-button').click(function(){
        ajaxReaquires();
      });
     
      
    });
