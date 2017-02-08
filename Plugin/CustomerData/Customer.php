<?php
/**
 * Section feeding datalayer in javascript
 *
 * @category  MagePal
 * @package   MagePal\GoogleTagManager
 * @author    Pascal Noisette <netpascal0123@aol.com>
 * @copyright 2017
 */
namespace MagePal\GoogleTagManager\Plugin\CustomerData;


class Customer
{
    /**
     * Customer session
     *
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * Constructor
     * 
     * @param \Magento\Customer\Model\Session $customerSession
     * 
     * @return void
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->_customerSession = $customerSession;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function afterGetSectionData($subject, $result)
    {
        $result = array_merge(
            $result,
            [
                'isLoggedIn' => $this->_customerSession->isLoggedIn(),
                'id' => $this->_customerSession->getCustomerId(),
                'groupId' => $this->_customerSession->getCustomerGroupId(),
            ]
        );

        return $result;
    }
}
