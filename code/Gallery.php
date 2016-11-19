<?php

class Gallery extends Page {

    public static $icon = 'simple_gallery/images/treeicons/news';
    public static $db = array();
    static $can_be_root = false;
    public static $has_many = array(
        'GalleryImages' => 'GalleryImage'
    );
    public static $has_one = array();
    public static $defaults = array();

    public function getCMSFields() {
        $f = parent::getCMSFields();
        $f->removeByName("Images");
        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        $gridFieldConfig->addComponent(new GridFieldBulkUpload());
        $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $gridFieldConfig->getComponentByType('GridFieldBulkUpload')->setUfSetup('setFolderName', 'Uploads/galleryimages/' . $this->URLSegment);
        $gridfield = new GridField('GalleryImages', 'Gallery  Image', $this->GalleryImages(), $gridFieldConfig);
        $f->addFieldToTab('Root.Gallery', $gridfield);

        return $f;
    }

    function MiniGalleryImages($limit =8) {
        return $this->GalleryImages()->sort('RAND()')->limit($limit);
    }

}

class Gallery_Controller extends Page_Controller {

    public function init() {
        parent::init();
        Requirements::css(SIMPLE_GALLERY . '/css/gallery.css');
    }

}
