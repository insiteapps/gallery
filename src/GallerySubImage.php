<?php

class GallerySubImage extends DataObject
{

    public static $default_sort = 'SortOrder';
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Description' => 'Text',
        'SortOrder' => 'Int',
    );
    private static $has_one = array(
        'Attachment' => 'GalleryFittedImage',
        'GalleryImage' => 'GalleryImage',
    );
    private static $has_many = array(
        'Images' => 'GalleryFittedImage'
    );
    static $summary_fields = array(
        'Thumbnail',
        'Name'
    );

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        //$f->removeByName("Images");


        $gridFieldConfig = GridFieldConfig_RecordEditor::create();
        $gridFieldConfig->addComponent(new GridFieldBulkUpload());
        $gridFieldConfig->addComponent(new GridFieldSortableRows('SortOrder'));
        $gridFieldConfig->getComponentByType('GridFieldBulkUpload')->setUfSetup('setFolderName', 'Uploads/galleryimages/images/' . $this->URLSegment);
        $gridfield = new GridField('Images', 'Images', $this->Images(), $gridFieldConfig);
        $f->addFieldToTab('Root.Images', $gridfield);


        return $f;
    }

    function SegmentFilter()
    {
        $parent = ($pId = $this->GalleryPageID) ? $this->GalleryPage() : $this->Gallery();
        return $parent->URLSegment;
    }

    function getThumbnail()
    {
        $image = $this->Attachment();
        if ($image && $image->ID) {
            return $image->CMSThumbnail();
        }
    }

    function Image()
    {
        $img = $this->Attachment();
        if ($img && $img->ID) {
            return $img->newClassInstance('GalleryFittedImage');
        }
        return false;
    }

}
