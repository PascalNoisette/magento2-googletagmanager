<?php

/**
 * DataLayer
 * Copyright © 2016 MagePal. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MagePal\GoogleTagManager\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Cookie\Helper\Cookie as CookieHelper;
use MagePal\GoogleTagManager\Helper\Data as GtmHelper;

/**
 * Google Tag Manager Page Block
 */
class GtmCode extends Template {

    /**
     * Google Tag Manager data
     *
     * @var MagePal\GoogleTagManager\Helper\Data
     */
    protected $_gtmHelper = null;

    /**
     * Cookie Helper
     *
     * @var \Magento\Cookie\Helper\Cookie
     */
    protected $_cookieHelper = null;
    
    /**
     * List of dependancies
     * 
     * @array
     */
    protected $_dependancies = array();

    /**
     * @param Context $context
     * @param CookieHelper $cookieHelper
     * @param GtmHelper $gtmHelper
     * @param array $data
     */
    public function __construct(
    Context $context, CookieHelper $cookieHelper, GtmHelper $gtmHelper, array $data = []
    ) {
        $this->_cookieHelper = $cookieHelper;
        $this->_gtmHelper = $gtmHelper;
        parent::__construct($context, $data);
    }

    /**
     * Get Account Id
     *
     * @return string
     */
    public function getAccountId() {
        return $this->_gtmHelper->getAccountId();
    }
    
    /**
     * Defer gtm loading
     */
    public function addDependancy($name)
    {
        $this->_dependancies[] = $name;
    }
    
    /**
     * List of requirejs ressource needed to gtm
     * 
     * @return array
     */
    public function getDependancies()
    {
        return $this->_dependancies;
    }

    /**
     * Render tag manager JS
     *
     * @return string
     */
    protected function _toHtml() {
       if (!$this->_gtmHelper->isEnabled()) {
            return '';
        }
        return parent::_toHtml();
    }

}
