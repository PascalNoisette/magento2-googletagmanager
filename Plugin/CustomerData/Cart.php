<?php
/**
 * Section feeding cart datalayer in javascript
 *
 * @category  MagePal
 * @package   MagePal\GoogleTagManager
 * @author    Pascal Noisette <netpascal0123@aol.com>
 * @copyright 2017
 */
namespace MagePal\GoogleTagManager\Plugin\CustomerData;


class Cart
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $checkoutSession;

    /**
     * Constructor 
     * 
     * @param \Magento\Checkout\Model\Session $checkoutSession
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function afterGetSectionData($subject, $result)
    {
        $quote = $this->checkoutSession->getQuote();

        $result = array_merge(
            $result,
            [
                'hasCoupons' => $quote->getCouponCode() ? true : false,
                'couponCode' => $quote->getCouponCode(),
                'total_value' => $quote->getGrandTotal(),
            ]
        );
        return $result;
    }
}
