<div class="LightGalleryContainer {$Style}Gallery">

    <div id="lightgallery" class="list-unstyled row isotopeWrapper">
        <% loop $GalleryItems %>

            <a data-fancybox="gallery" href="{$Image.URL}"
               class=" col-sm-{$Top.ColumnsSpanWidth} isotopeItem {$SegmentFilter}">
                <img class="img-responsive" src="{$Image.CroppedResize(1200,800).URL}">
            </a>

        <% end_loop %>
    </div>
</div>

