<?php

/*
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\View\Requirements;
*/

class GalleryPage extends Page
{

    public static $icon             = 'simple_gallery/images/treeicons/news';
    public static $db               = array();
    static        $can_be_root      = false;
    public static $allowed_children = array( "Gallery" );
    public static $has_many         = array(
        'GalleryImages' => 'GalleryImage',
    );
    public static $has_one          = array();
    public static $defaults         = array();

    public function getCMSFields()
    {

        $f = parent::getCMSFields();
        $f->removeByName( "Images" );
        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        $gridFieldConfig->addComponent( new GridFieldBulkUpload() );
        $gridFieldConfig->addComponent( new GridFieldSortableRows( 'SortOrder' ) );
        $gridFieldConfig->getComponentByType( 'GridFieldBulkUpload' )
                        ->setUfSetup( 'setFolderName', 'Uploads/galleryimages/' . $this->URLSegment );
        $gridfield = new GridField( 'GalleryImages', 'Gallery  Image', $this->GalleryImages(), $gridFieldConfig );
        $f->addFieldToTab( 'Root.Gallery', $gridfield );

        return $f;
    }

    public function canCreateee($member = null)
    {
        return false;
    }

    function MiniGalleryImages( $limit = 8 )
    {

        return $this->GalleryImages()->sort( 'RAND()' )->limit( $limit );
    }

    function Image( $resize = true )
    {

        if ( count( $this->GalleryImages() ) ) {
            $image = $this->GalleryImages()->first();
            if ( $image ) {
                $Attachment         = $image->Attachment();
                $GalleryFittedImage = $Attachment->newClassInstance( 'GalleryFittedImage' );
                if ( $resize ) {
                    return $GalleryFittedImage->CroppedResize( 360, 280 );
                }

                return $GalleryFittedImage;
            }

        }

        return false;
    }

    function ChildImageList()
    {

        $images = $this->GalleryImages();
        if ( count( $images ) ) {
            $AttachmentIDs = $images->column( "AttachmentID" );
            $images        = Image::get()->byIDs( $AttachmentIDs )->exclude( array( "ID" => $this->Image()->ID ) );

            return implode( ',', $images->column( "Filename" ) );
        }

        return false;
    }
}

class GalleryPage_Controller extends Page_Controller
{

    public function init()
    {

        parent::init();
        Requirements::css( SIMPLE_GALLERY . '/css/gallery.css' );
    }

}
