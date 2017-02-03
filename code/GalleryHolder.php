<?php

class GalleryHolder extends Page
{

    public static $icon = 'simple_gallery/images/treeicons/news';
    public static $allowed_children = array("GalleryPage");
    public static $db = array(
        'ShowCaption' => 'Boolean',
        'SingleGallery' => 'Boolean',
        "GalleryLayout" => "Enum('List,Masonry','List')",
        "Columns" => "Int",
        //"Type" => "Enum('Items,Category','Items')",
    );
    public static $has_many = array();
    public static $has_one = array();
    public static $defaults = array();


    function getPageSetupFields()
    {
        $fields = CompositeField::create(
            CheckboxField::create("SingleGallery"),
            CheckboxField::create("ShowCaption"),
            DropdownField::create("GalleryLayout")
                ->setSource($this->dbObject("GalleryLayout")->enumValues()),
            DropdownField::create("Columns")->setSource(self::getColumnEnums())
        );
        return $fields;
    }

    public function getCMSFields()
    {
        $f = parent::getCMSFields();

        $setup = PageSetupBar::create('Gallery', $this->getPageSetupFields());
        $f->insertBefore($setup, 'Root');
        $f->fieldByName('Root')->setTemplate('PageSetupBar');

        return $f;
    }

    function HasCategories()
    {
        $children = $this->Children();
        $Galleries = Gallery::get()
            ->filter("ParentID", $children->column());
        if (count($Galleries)) {
            return true;
        }

        return false;
    }

    function GalleryItems($limit = null)
    {
        $children = $this->Children();
        if ($this->Type === 'Category') {
            $galley = ArrayList::create();
            if (count($children)) {
                foreach ($children as $child) {
                    if ($child->Image()) {
                        $data = array();

                        $data['SegmentFilter'] = $child->URLSegment;
                        $data['Image'] = $child->Image();
                        $data['LargeImage'] = $child->Image(false);
                        $data['ChildImageList'] = $child->ChildImageList();
                        $data['Category'] = $child;
                        $data['GalleryPage'] = $child;
                        $galley->push(ArrayData::create($data));
                    }

                }
            }
            return $galley->limit($limit);

        }

        if ($children) {
            return GalleryImage::get()
                ->filter("GalleryPageID", $children->column())
                ->sort("RAND()")
                ->limit($limit);
        }

        return false;

    }
}

class GalleryHolder_Controller extends Page_Controller
{

    public function init()
    {
        parent::init();

        Requirements::css(INSITEAPPS_GALLERY_DIR . '/css/GalleryManager.css');
        Requirements::javascript(INSITEAPPS_GALLERY_DIR . '/js/GalleryManager.js');

    }


}
