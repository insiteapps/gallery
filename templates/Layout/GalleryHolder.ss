<div class="padd15">
    <div class="row">
        <div class="col-xs-12">
            <ul id="filters" class="filters">
                <li><a href="#" data-filter="*" class="selected">show all</a></li>
                <% loop $Children %>
                <li><a href="#" data-filter=".{$URLSegment}">$Title</a></li>
                <% end_loop %>
            </ul>
          
        </div>
    </div>
    <div class="row">            	
        <div id="gallery" class="gallery">
            <% loop $GalleryItems %>
            <!-- <h4>Gallery item -->	
            <div class="col-sm-3 item {$GalleryPage.URLSegment}">
                <a class="preview lightbox" href="$Image.URL">
                    <img src="$Image.CroppedResize(255,180).URL" data-original="$Image.CroppedResize(255,180).URL" alt=""  />
                </a>
                <h4 class="hide">$Name</h4>            
            </div>
            <!-- close <h4>Gallery item -->
            <% end_loop %>
        </div>
    </div>
</div>