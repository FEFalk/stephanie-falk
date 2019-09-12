(function loadInstagram($) {

    var $grid = $('.grid').masonry({
        // set itemSelector so .grid-sizer is not used in layout
        itemSelector: '.grid-item',
        // use element for option
        columnWidth: '.grid-sizer',
        percentPosition: true,
        gutter: 15
    });
    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });
    // var isDesktopWidth = window.matchMedia("(min-width: 63.9375em)").matches;
    // var isMobileWidth = window.matchMedia("(max-width: 39.9375em)").matches;
    // var imgs = [];
    // var feed = new Instafeed({
    //     target: 'instagram-grid',
    //     get: 'user',
    //     userId: 1362124742,
    //     accessToken: '54974439.3a81a9f.c81154a577c94e86a35b21ee2c007aea',
    //     sortBy: 'most-recent',
    //     links: 'true',
    //     resolution: 'standard_resolution',
    //     template: '<div class="grid-item"><a href="{{link}}"><img class="{{orientation}}" src="{{image}}" /></a></div>',
    //     limit: 100,
    //     // limit: isDesktopWidth ? 15 : isMobileWidth ? 8 : 6,
    //     mock: true,

    //     after: function(data){
    //          $grid = $('.grid').masonry({
    //             // set itemSelector so .grid-sizer is not used in layout
    //             itemSelector: '.grid-item',
    //             // use element for option
    //             columnWidth: '.grid-sizer',
    //             percentPosition: true,
    //             gutter: 15
    //         });
    //         $grid.imagesLoaded().progress( function() {
    //             $grid.masonry('layout');
    //         });

    //         if (!this.hasNext()) {
    //             $('#loadMoreButton').addClass('hidden');
    //         }
    //     },

    //     success: function(data){
    //         var images = data.data, result, i, image;
    //         imgs = [];
    //         for (i = 0; i < images.length; i++) {
    //             image = images[i];
    //             var activeTags = $('.tag.active');
    //             var br = false;
    //             $.each(activeTags, function(i, v){
    //                 br = false;
    //                 console.log($(v).text());
    //                 if(image.tags && image.tags.indexOf($(v).text().trim()) < 0)
    //                 {
    //                     br = true;
    //                     return false;
    //                 }
    //             });
    //             if(br) continue;
    //             imgWidth = image.images[this.options.resolution].width;
    //             imgHeight = image.images[this.options.resolution].height;
    //             imgOrient = "square";
    //             if (imgWidth > imgHeight) {
    //               imgOrient = "landscape";
    //             }
    //             if (imgWidth < imgHeight) {
    //               imgOrient = "portrait";
    //             }
    //             result = this._makeTemplate(this.options.template, {
    //                 model: image,
    //                 id: image.id,
    //                 link: image.link,
    //                 tags: image.tags,
    //                 image: image.images[this.options.resolution].url,
    //                 orientation: imgOrient
    //             });

    //             imgs.push(result);
    //         }
    //         if (imgs.length > 10) {
    //             imgs = imgs.slice(0, 10);
    //           }

    //         for (i = 0; i < imgs.length; i++) {
    //             console.log(imgs[i]);
    //             var $content = $( imgs[i]);
    //             $grid.append($content).masonry('appended', $content).masonry();
    //         }
            
    //     }
    // });
    // $('#loadMoreButton').click(function() {
    //     feed.next();
    // });

    $('#filter-button').click(function(e) {
        $(this).toggleClass("active");
        $(".tag-groups-cloud").toggleClass("active");
        if($(".tag-groups-cloud").hasClass("active")){
            $(".tag-groups-cloud").fadeIn(200);
        }
        else
            $(".tag-groups-cloud").fadeOut(200);
    });
    $('.tag-group').click(function(e) {
        var caller = $(e.target);
        $(caller).toggleClass('active');
        $('.tag-groups-cloud').addClass('loading');

        var activeTagGroups = $('.tag-group.active');

        var tagGroupArray = [];

        var activeTags = [];
        var activeTagsText = [];
        
        activeTagGroups.each(function(i, v)
        {
            activeTags = ($(v).next('.tags-container').find('.tag-groups-label'));

            activeTags.each(function(j, k){
                activeTagsText.push($(k).text());
            });

            tagGroupArray.push(activeTagsText);
            activeTagsText = [];
        });

        var jsonString = JSON.stringify(tagGroupArray);
        var data = {
            action: 'update_instagram',
            tags: jsonString

        }

        $.post(one_ajax.ajaxurl, data, function(response, status) {
            var items = $(response).filter('.grid-item');
            var instagramGrid = $("#instagram-grid");
            instagramGrid.data("page", 1);
            //console.log(response);
            //var filteredItems = $('.grid-item').not($(items)).remove();

            if(items.length < 15)
                $("#loadMoreButton").hide();
            else
                $("#loadMoreButton").show();

            $('.grid-item').filter(function(){
                var gridItem = $(this);
                $(items).each(function(){
                    if($(gridItem).find('img').attr('src') != $(this).find('img').attr('src'))
                        $(gridItem).remove();
                });
                
            });

            $(items).filter(function(){
                var item = $(this);
                $('.grid-item').each(function(){
                    if($(item).find('img').attr('src') == $(this).find('img').attr('src'))
                        items = $(items).not($(item));
                });
                
            });
            $grid.append($(items)).masonry('appended', $(items));
            
            setTimeout(function(){
                $grid.masonry('layout');
                $('.tag-groups-cloud').removeClass('loading');
            }, 500);

        },
        "html"
        )
        .fail(function(jqXhr, textStatus, errorThrown){
            console.log(errorThrown);
        });
    });

    $('#loadMoreButton').click(function(e) {
        var caller = $(e.target);
        $(caller).toggleClass('active');
        $('.tag-groups-cloud').addClass('loading');

        var activeTagGroups = $('.tag-group.active');

        var tagGroupArray = [];

        var activeTags = [];
        var activeTagsText = [];
        
        activeTagGroups.each(function(i, v)
        {
            activeTags = ($(v).next('.tags-container').find('.tag-groups-label'));

            activeTags.each(function(j, k){
                activeTagsText.push($(k).text());
            });

            tagGroupArray.push(activeTagsText);
            activeTagsText = [];
        });

        var instagramGrid = $("#instagram-grid");
        var page = instagramGrid.data("page");

        var jsonString = JSON.stringify(tagGroupArray);
        var data = {
            action: 'loadmore_instagram',
            page: page,
            tags: jsonString

        }


        $.post(one_ajax.ajaxurl, data, function(response, status) {
            var items = $(response).filter('.grid-item');
            var newPage = page+1;
            instagramGrid.data("page", newPage);
            //console.log(response);
            //var filteredItems = $('.grid-item').not($(items)).remove();

            $(items).filter(function(){
                var item = $(this);
                $('.grid-item').each(function(){
                    if($(item).find('img').attr('src') == $(this).find('img').attr('src'))
                        items = $(items).not($(item));
                });
            });
            $grid.append($(items)).masonry('appended', $(items));
            
            setTimeout(function(){
                $grid.masonry('layout');
                $('.tag-groups-cloud').removeClass('loading');
            }, 300);

        },
        "html"
        )
        .fail(function(jqXhr, textStatus, errorThrown){
            console.log(errorThrown);
        });
    });

    // function update_filters(callerTag)
    // {
    //     var callerTag = $callerTag;
    //     var activeTags = $('.active-tags-container .active-tag');
    //     if(caller.hasClass('active'))
    //         activeTags.append(callerTag);
    //     else
    //         activeTags.remove(callerTag);
    // }


    // feed.run();

    




    // var token = '54974439.3a81a9f.c81154a577c94e86a35b21ee2c007aea', // learn how to obtain it below
    //     userid = 1362124742, // User ID - get it in source HTML of your Instagram profile or look at the next example :)
    //     num_photos = 12; // how much photos do you want to get
    
    // $.ajax({
    //     url: 'https://api.instagram.com/v1/users/self/media/recent', // or /users/self/media/recent for Sandbox
    //     dataType: 'jsonp',
    //     type: 'GET',
    //     data: {access_token: token, count: num_photos},
    //     success: function(data){
    //         console.log(data);
    //         for( x in data.data ){
    //             var commentText = '';
    //             $.ajax({
    //                 url: 'https://api.instagram.com/v1/media/'+data.data[x].id+'/comments', // or /users/self/media/recent for Sandbox
    //                 dataType: 'jsonp',
    //                 type: 'GET',
    //                 data: {access_token: token},
    //                 success: function(data){
    //                     for( i in data.data ){
    //                         commentText += data.data[i].text;
    //                     }
    //                 },
    //                 error: function(data){
    //                     console.log(data); // send the error notifications to console
    //                 }
    //             });

    //             $('#instagram-grid').append('<div class="grid-item"><img src="'+data.data[x].images.standard_resolution.url+
    //             '"><div class="comments">'+commentText+'</div></div>'); 
                
    //             // data.data[x].images.low_resolution.url - URL of image, 306х306
    //             // data.data[x].images.thumbnail.url - URL of image 150х150
    //             // data.data[x].images.standard_resolution.url - URL of image 612х612
    //             // data.data[x].link - Instagram post URL 
    //         }
    //     },
    //     error: function(data){
    //         console.log(data); // send the error notifications to console
    //     }
    // });

})(jQuery);