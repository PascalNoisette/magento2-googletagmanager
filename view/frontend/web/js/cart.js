/**
 * Library to push cart items to datalayer
 * 
 * @category  MagePal
 * @package   MagePal_GoogleTagManager
 * @author    Pascal Noisette <netpascal0123@aol.com>
 * @copyright 2017
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
define("magepal_googletagmanager_block_cart", ['Magento_Customer/js/customer-data'], function(customerData){
    var cart = customerData.get("cart")();
    var result = {"hasItems":false};

    if (typeof(cart.items) != "undefined" && cart.items.length>0) {
        result.hasItems = true;
        result.items = [];
        cart.items.forEach(function (item) {
            result.items.push({
                'sku'      : item.product_sku,
                'name'     : item.product_name,
                'price'    : item.product_price_value,
                'quantity' : item.qty
            });
        });
        result.total = cart.total_value;
        result.itemCount = cart.summary_count;
        result.hasCoupons = cart.hasCoupons;
        if (cart.hasCoupons) {
            result.couponCode = cart.couponCode;
        }
    }
    dataLayer[0]["cart"] = result;

    return {};
});