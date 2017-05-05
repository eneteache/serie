function recuperar() {
  

  $(document).ready(function(){


    // generamos un evento cada vez que se pulse una tecla (.key)
    //$("input[name=id]").click(function(){
    var tral = "";
    $('input[name=yt]').val( tral );
    var tipo = document.getElementById("tipo").value;

    if (tipo == "pelicula") {    
      var url           = 'https://api.themoviedb.org/3/movie/';
    }

    if (tipo == "serie") {
      var url           = 'https://api.themoviedb.org/3/tv/'; 
    }

      var identificador = $('input[name=id]').get(0).value;
      var idioma        = '&language=es';
      var key_api       = '&api_key=9e51a426706d7dc458f162e67740c39f';
      var mod           = '?append_to_response=trailers';

      $.getJSON( url + identificador + mod + idioma + key_api, function(tmdb) {

        $.each(tmdb, function(key, val) {
          if(key == "genres"){
            var genr = "";
            $.each( tmdb.genres, function( i, item ) {

              genr += "" + item.name + ", ";
              genr1 = item.name;

              $('input[name=newcategory]').val( genr1 );
              $('#category-add-submit').trigger('click');
              $('#category-add-submit').prop("disabled", false);
              $('input[name=newcategory]').val("");

            });

            $('input[name=genero]').val( genr );

          }else if(key == "trailers"){
            //var tral = "";
            $.each( tmdb.trailers.youtube, function( i, item ) {
              tral += "[" + item.source + "]";
            });
            $('input[name=yt]').val( tral );
          }else if(key == "images"){
          
            var imgt = "";
            $.each( tmdb.images.backdrops, function( i, item ) {
              imgt += item.file_path + "\n";  
            });
            $('textarea[name=' +key+ ']').val( imgt );

          }else if(key == "release_date"){

            $('input[name=anio]').val( val.slice(0,4) );
            $('#new-tag-fecha').val( val.slice(0,4) );
  
          }else if(key == "title"){

            $('input[name=titulo]').val(val);
            $('label#title-prompt-text').addClass('screen-reader-text');
            $('input[name=post_title]').val(val);

          }else{

            $('input[name='+key+']').val(val);  
          }


        });

        if (tral == "") {

          var videos = "/videos";

          $.getJSON( url + identificador + videos + mod + idioma + key_api, function(tmdb) {
            $.each(tmdb, function(key,val){
              if (key == "results") {
                $.each(tmdb.results, function (i, item) {
                  tral += "[" + item.key + "]";
                })
              $('input[name=yt]').val( tral );
              }
            })
          })
        }

      })
    //}); 
  });
}