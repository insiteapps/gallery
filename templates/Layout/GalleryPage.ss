<div class="padd15">

    $Content

    <% if GalleryImages %>
    <div class="row">            	
        <div id="gallery" class="gallery">
            <% loop GalleryImages %>
            <!-- <h4>Gallery item -->	
            <div class="span3 item {$GalleryPage.URLSegment}">
                <a class="preview" href="$Image.URL" rel="prettyPhoto" >
                    <img src="$Image.CroppedResize(270,180).URL" data-original="$Image.CroppedResize(270,180).URL" alt="" height="180" width="280" />
                </a>
                <h4 class="hide">$Name</h4>            
            </div>
            <!-- close <h4>Gallery item -->
            <% end_loop %>

        </div>
    </div>
    <% end_if %>
</div>