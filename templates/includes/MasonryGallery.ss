
<div class="isotopeContainer gallery-grid gallery-masonry row clearfix" data-gallery-hidden-on-page-load="true">
    <div class="gallery-loader"></div>

    <% loop $GalleryItems %>
        <div class="gallery-item item col-xxs-6 col-sm-{$Top.ColumnsWidth} {$SegmentFilter}">
            <a href="{$Image.URL}" class="img-mask-effect fade popup-gallery" data-lightbox="main-gallery">
                <img src="{$Image.URL}" alt="{$Name}"/>
                <i class="mask"><span class="glyphicon glyphicon-search"></span></i>
            </a>
        </div>
    <% end_loop %>
</div><!-- .gallery-grid -->
