<?php

class GalleryHolder extends Page
{
    
    public static $icon = 'simple_gallery/images/treeicons/news';
    
    public static $allowed_children = array( "GalleryPage" );
    
    public static $db = array(
        'ShowCaption'   => 'Boolean',
        'SingleGallery' => 'Boolean',
        "GalleryLayout" => "Enum('ListGallery,MasonryGallery','ListGallery')",
        "Columns"       => "Int",
        "Style"         => "Enum('NoSpace,Normal,SmallPadding','Normal')",
        //"Type" => "Enum('Items,Category','Items')",
    );
    
    public static $has_many = array();
    
    public static $has_one = array();
    
    public static $defaults = array();
    
    
    public function getManagerFields()
    {
        
        $fields = parent::getManagerFields();
        $fields->push( ToggleCompositeField::create( 'GallerySetup', 'Gallery Setup', [
            CheckboxField::create( "SingleGallery" ),
            CheckboxField::create( "ShowCaption" ),
            DropdownField::create( "GalleryLayout" )->setSource( $this->dbObject( "GalleryLayout" )->enumValues() ),
            DropdownField::create( "Columns" )->setSource( self::getColumnEnums() ),
            DropdownField::create( "Style" )->setSource( $this->dbObject( "Style" )->enumValues() ),
        ] ) );
        $this->extend( 'updateManagerFields', $fields );
        
        return $fields;
    }
    
    public function getCMSFields()
    {
        
        $f = parent::getCMSFields();
        
        return $f;
    }
    
    function HasCategories()
    {
        
        $children  = $this->Children();
        $Galleries = Gallery::get()->filter( "ParentID", $children->column() );
        if ( count( $Galleries ) ) {
            return true;
        }
        
        return false;
    }
    
    function GalleryItems( $limit = null )
    {
        
        $children = $this->Children();
        if ( $this->Type === 'Category' ) {
            $galley = ArrayList::create();
            if ( count( $children ) ) {
                foreach ( $children as $child ) {
                    if ( $child->Image() ) {
                        $data = array();
                        
                        $data[ 'SegmentFilter' ]  = $child->URLSegment;
                        $data[ 'Image' ]          = $child->Image();
                        $data[ 'LargeImage' ]     = $child->Image( false );
                        $data[ 'ChildImageList' ] = $child->ChildImageList();
                        $data[ 'Category' ]       = $child;
                        $data[ 'GalleryPage' ]    = $child;
                        $galley->push( ArrayData::create( $data ) );
                    }
                    
                }
            }
            
            return $galley->limit( $limit );
            
        }
        
        if ( $children ) {
            return GalleryImage::get()->filter( "GalleryPageID", $children->column() )->sort( "RAND()" )
                               ->limit( $limit );
        }
        
        return false;
        
    }
}

class GalleryHolder_Controller extends Page_Controller
{
    
    public function init()
    {
        
        parent::init();
        
        Requirements::javascript( INSITEAPPS_GALLERY_DIR . '/js/GalleryManager.js' );
        
    }
    
    
}
