<div class="LightGalleryContainer {$Style}Gallery">

    <div id="lightgallery" class="list-unstyled row isotopeWrapper">
        <% loop $GalleryItems %>
            <a data-fancybox="gallery" href="<% if $VideoCode %>//www.youtube.com/watch?v={$VideoCode} <% else %>$Image.URL<% end_if %>"
               class=" col-sm-{$Top.ColumnsSpanWidth} isotopeItem {$SegmentFilter}">
                <img class="img-responsive" src="{$Image.CroppedResize(1200,800).URL}">
            </a>
        <% end_loop %>
    </div>
</div>
