<?php
/**
 *
 * @copyright (c) 2018 Insite Apps - http://www.insiteapps.co.za
 * @package       insiteapps
 * @author        Patrick Chitovoro  <patrick@insiteapps.co.za>
 * All rights reserved. No warranty, explicit or implicit, provided.
 *
 * NOTICE:  All information contained herein is, and remains the property of Insite Apps and its suppliers,  if any.
 * The intellectual and technical concepts contained herein are proprietary to Insite Apps and its suppliers and may be
 * covered by South African. and Foreign Patents, patents in process, and are protected by trade secret or copyright
 * laws. Dissemination of this information or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from Insite Apps. Proprietary and confidential. There is no freedom to use, share or change
 * this file.
 *
 *
 */

/**
 * @namespace InsiteApps\Gallery
 * @class     GalleryController
 * @package   builder
 * @year      2018
 * @file      GalleryController
 * @author    Itayi Patrick
 */


namespace InsiteApps\Gallery;

use InsiteMainController;

class GalleryController extends InsiteMainController
{
    private static $allowed_actions = array(
        'load',
    );
    
    public function Link( $action = null )
    {
        return "gllry/$action";
    }
    
    /**
     * @param string $action
     *
     * @return string
     */
    public static function find_link( $action = '' )
    {
        
        return self::create()->Link( $action );
    }
    
    
    public function load()
    {
        $block_id = $this->urlParamsID();
        
        if ( $block_id ) {
            $oGalleryBlock = \GalleryBlockSection::get()->byID( $block_id );
            
          return $oGalleryBlock->renderWith( $oGalleryBlock->GalleryLayout );
          
        }
        
        
    }
}
