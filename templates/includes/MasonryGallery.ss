<div class="isotopeContainer gallery-grid gallery-masonry row clearfix {$Style}Gallery"
     data-gallery-hidden-on-page-load="true">
    <div class="gallery-loader"></div>

    <% loop $GalleryItems %>
        <div class="gallery-item imgWrapper item {$Up.ColumnsClasses} {$SegmentFilter}">
            <% if $VideoCode %>
                <a class="popup-youtube" title="{$Name}" href="//www.youtube.com/watch?v={$VideoCode}">
                    <img alt="" src="{$Image.URL}" class="img-responsive">
                    <i class="fa fa-youtube-play fa-3x" aria-hidden="true"></i>
                </a>
            <% else %>
                <a data-fancybox="galleryy" href="{$Image.URL}" title="{$Name}" class="img-mask-effect fancybox-gallery fade popup-galleryy"
                   data-lightboxxx="main-gallery">
                    <img src="{$Image.URL}" alt="{$Name}"/>
                    <i class="mask"><span class="glyphicon glyphicon-search"></span></i>
                </a>
            <% end_if %>
        </div>
    <% end_loop %>
</div>
