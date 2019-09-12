<?php

class GalleryImage extends DataObject
{
    
    public static  $default_sort   = 'SortOrder';
    private static $db             = array(
        'Name'        => 'Varchar(255)',
        'Description' => 'Text',
        'VideoCode'   => 'Varchar(255)',
        'SortOrder'   => 'Int',
    );
    private static $has_one        = array(
        'Attachment'  => 'Image',
        'GalleryPage' => 'GalleryPage',
        'Gallery'     => 'Gallery',
    );
    private static $has_many       = array(
        'Images' => 'GallerySubImage',
    );
    private static $summary_fields = array(
        'Thumbnail',
        'Name',
    );
    
    public function ChildImageList()
    {
        
        $images = $this->Images();
        if ( count( $images ) ) {
            $AttachmentIDs = $images->column( "AttachmentID" );
            $images        = Image::get()->byIDs( $AttachmentIDs );
            
            return implode( ',', $images->column( "Filename" ) );
        }
        
        return false;
    }
    
    public function getCMSFields()
    {
        
        $f = parent::getCMSFields();
        $f->removeByName( [
            "SortOrder",
            "GalleryPageID",
        ] );
        
        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        $gridFieldConfig->addComponent( new GridFieldBulkUpload() );
        $gridFieldConfig->addComponent( new GridFieldSortableRows( 'SortOrder' ) );
        $gridFieldConfig->getComponentByType( 'GridFieldBulkUpload' )
                        ->setUfSetup( 'setFolderName', 'Uploads/galleryimages/images/' . $this->URLSegment );
        $gridfield = new GridField( 'Images', 'Images', $this->Images(), $gridFieldConfig );
        $f->addFieldToTab( 'Root.Images', $gridfield );
        
        
        return $f;
    }
    
    public function SegmentFilter()
    {
        
        //   $parent = ($pId = $this->GalleryPageID) ? $this->GalleryPage() : $this->Gallery();
        if ( $this->GalleryPageID ) {
            $parent = $this->GalleryPage();
            
            return $parent->URLSegment;
        }
        
        return false;
    }
    
    public function getThumbnail()
    {
        
        $image = $this->Attachment();
        if ( $image && $image->ID ) {
            return $image->CMSThumbnail();
        }
    }
    
    public function Image()
    {
        
        $img = $this->Attachment();
        if ( $img && $img->ID ) {
            return $img->newClassInstance( 'GalleryFittedImage' );
        }
        $this->Content = str_replace( "http://", "//", $this->Content );
        
        return false;
    }
    
}
