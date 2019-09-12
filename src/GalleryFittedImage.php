<?php

class GalleryFittedImage extends Image
{
    
    
    function generateGalleryImage( $gd )
    {
        
        $gd->setQuality( 100 );
        
        return $gd->croppedResize( 940, 380 );
    }
    
    function generateCroppedResize( $gd, $width, $height )
    {
        
        return $gd->croppedResize( $width, $height );
    }
    
    function generatePaddedResize( $gd, $width, $height )
    {
        
        return $gd->paddedResize( $width, $height );
    }
    
    function generateFittedResize( $gd, $width, $height )
    {
        
        return $gd->fittedResize( $width, $height );
    }
    
    function generateResize( $gd, $width, $height )
    {
        
        return $gd->resize( $width, $height );
    }
    
    function generateResizeByWidth( $gd, $width )
    {
        
        return $gd->resizeByWidth( $width );
    }
    
    function generateResizeByHeight( $gd, $height )
    {
        
        return $gd->resizeByHeight( $height );
    }
    
    function generateResizeRatio( $gd, $width, $height )
    {
        
        return $gd->resizeRatio( $width, $height );
    }
    
}
