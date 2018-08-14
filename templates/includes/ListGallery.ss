<div class="row portfolio-items isotopeWrapper clearfix imgHover {$Style}Gallery">

    <% loop $GalleryItems %>

        <article class="{$Up.ColumnsClasses}  isotopeItem {$SegmentFilter}">
            <section class="imgWrapper">
                <% if $VideoCode %>
                    <a class="popup-youtube" href="//www.youtube.com/watch?v={$VideoCode}">

                        <img alt="" src="{$Image.CroppedResize(800,600).URL}"
                             class="img-responsive">

                        <i class="fa fa-youtube-play fa-3x" aria-hidden="true"></i>

                    </a>
                <% else %>
                    <a data-fancybox="gallery" title="{$Name}" g
                       href="<% if $Category %>$LargeImage.URL<% else %>$Image.URL<% end_if %>"
                       class="image-linkk" data-gallery="{$ChildImageList}">
                        <img alt="{$Name}" src="{$Image.CroppedResize(800,600).URL}"
                             class="img-responsive">
                    </a>
                <% end_if %>

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
