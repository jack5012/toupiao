// In JavaScript
//_______________________

// listener to the [select from existing photos] button
$('#photosModal').on('shown.bs.modal', function () {
    // get the first page of photos (paginated)
    getPhotos(function(photosObj){
        displayPhotos(photosObj);
    });
});

/**
 * get the photos paginated, and display them in the modal of selecting from existing photos
 *
 * @param page
 */
function getPhotos(callback) {

    $.ajax({
        type: "GET",
        dataType: 'json',
        url: Routes.cms_photos, // this is a variable that holds my route url
        data:{
            'page': window.current_page + 1 // you might need to init that var on top of page (= 0)
        }
    })
        .done(function( response ) {
            var photosObj = $.parseJSON(response.photos);
            console.log(photosObj);

            window.current_page = photosObj.current_page;

            // hide the [load more] button when all pages are loaded
            if(window.current_page == photosObj.last_page){
                $('#load-more-photos').hide();
            }

            callback(photosObj);
        })
        .fail(function( response ) {
            console.log( "Error: " + response );
        });
}

/**
 * @param photosObj
 */
function displayPhotos(photosObj)
{
    var options = '';

    $.each(photosObj.data, function(key, value){
        options = options + "<option data-img-src='"+value.thumbnail+"' value='"+value.id+"'></option>";
    });

    $('#photos-selector').append(options);

    $("select").imagepicker();
}

// listener to the [load more] button
$('#load-more-photos').on('click', function(e){
    e.preventDefault();

    getPhotos(function(photosObj){
        displayPhotos(photosObj);
    });

});