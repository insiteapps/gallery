<div class="row portfolio-items isotopeWrapper clearfix imgHover {$Style}Gallery">

    <% loop $GalleryItems %>

        <article class="col-sm-{$Top.ColumnsSpanWidth} isotopeItem {$SegmentFilter}">
            <section class="imgWrapper">

                <a data-fancybox="gallery" href="<% if $Category %>$LargeImage.URL<% else %>$Image.URL<% end_if %>"
                   class="image-linkk" title="Zoom" data-gallery="{$ChildImageList}">
                    <img alt="" src="{$Image.CroppedResize(800,600).URL}"
                         class="img-responsive">
                </a>
            </section>

            <div class="gallery-details">

                <% if $GalleryPage.ShowTitle %>
                    <h3 class="gallery-title">{$GalleryPage.Title}</h3>
                <% end_if %>

                <% if $GalleryPage.ShowCaption %>
                    <article class="gallery-caption">
                        $GalleryPage.PageSummary(150)
                    </article>
                <% end_if %>
            </div>

            <% if $Category %>
                <% with $Category %>
                    <section class="boxContent">
                        <h3>{$Title}</h3>
                        <article>
                            $PageSummary(150)<br/>
                            <a href="javascript:void(0);"
                               class="moreLink portfolioSheet">&rarr; read more</a>
                        </article>
                    </section>
                <% end_with %>
            <% end_if %>
        </article>
    <% end_loop %>
</div>
