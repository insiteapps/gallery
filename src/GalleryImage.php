<?php

class GalleryImage extends DataObject
{

    public static $default_sort = 'SortOrder';
    private static $db = array(
        'Name' => 'Varchar(255)',
        'Description' => 'Text',
        'VideoCode' => 'Varchar(255)',
        'SortOrder' => 'Int',
    );
    private static $has_one = array(
        'Attachment' => 'Image',
        'GalleryPage' => 'GalleryPage',
    );
    private static $has_many = array(
        'Images' => 'GallerySubImage'
    );
    static $summary_fields = array(
        'Thumbnail',
        'Name'
    );

    function ChildImageList(){
       $images = $this->Images();
        if(count($images)){
            $AttachmentIDs =  $images->column("AttachmentID");
            $images = Image::get()
                ->byIDs($AttachmentIDs);
            return implode(',', $images->column("Filename"));
        }
        return false;
    }

    public function getCMSFields()
    {
        $f = parent::getCMSFields();
        $f->removeByName(["SortOrder","GalleryPageID"]);

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
        }$this->Content = str_replace("http://", "//", $this->Content);
        return false;
    }

}
