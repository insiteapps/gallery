<link href="/insiteapps-gallery/plugIns/lightGallery/css/lightgallery.css" rel="stylesheet">
<link href="/insiteapps-gallery/plugIns/lightGallery/css/lightgallery.min.css" rel="stylesheet">
<link href="/insiteapps-gallery/plugIns/lightGallery/css/lg-fb-comment-box.css" rel="stylesheet">
<link href="/insiteapps-gallery/plugIns/lightGallery/css/lg-fb-comment-box.min.css" rel="stylesheet">
<link href="/insiteapps-gallery/plugIns/lightGallery/css/lg-transitions.css" rel="stylesheet">
<link href="/insiteapps-gallery/plugIns/lightGallery/css/lg-transitions.min.css" rel="stylesheet">
<link href="/insiteapps-gallery/css/LightGalleryCustom.css" rel="stylesheet">


<div class="LightGalleryContainer {$Style}Gallery">

    <div id="lightgallery" class="list-unstyled row isotopeWrapper">
            <% loop $GalleryItems %>

                <a data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"
                   href="{$Image.CroppedResize(1200,800).URL}"
                   class=" col-sm-{$Top.ColumnsSpanWidth} isotopeItem {$SegmentFilter}">
                    <img class="img-responsive" src="{$Image.CroppedResize(1200,800).URL}">

                </a>

            <% end_loop %>
    </div>
</div>
