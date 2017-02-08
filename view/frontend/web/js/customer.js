/**
 * Library to push customer to datalayer
 * 
 * @category  MagePal
 * @package   MagePal_GoogleTagManager
 * @author    Pascal Noisette <netpascal0123@aol.com>
 * @copyright 2017
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
define("magepal_googletagmanager_block_customer", ['Magento_Customer/js/customer-data'], function(customerData){

    var result = {"isLoggedIn":false};
    var customer = customerData.get("customer")();

    if (customer.isLoggedIn) {
        result.id = customer.id;
        result.groupId = customer.groupId;
        result.isLoggedIn = customer.isLoggedIn;
    }

    dataLayer[0]["customer"] = result;
    
    return {};
});