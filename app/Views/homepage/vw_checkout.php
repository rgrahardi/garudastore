<?php foreach ($order->getResult() as $key) {
    $productName = $key->name;
    $productPrice = $key->price;
    $productId = $key->id;
}
?>

<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <div class="row">
            <form action="/checkout/processcheckout" method="post" target="_blank">
                <div class="col-12">
                    <div class="coupon-accordion">
                        <!--Accordion Start-->
                        <h3>Have a discount voucher? <span id="showcoupon"><b>Click here to enter your code</b></span></h3>
                        <div id="" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <p class="checkout-coupon">
                                    <input name="voucherCode" placeholder="Voucher code" type="text">
                                    <input name="productId" type="hidden" value="<?= $productId ?>">
                                    <button type="button" class="btn btn-info" id="voucher">Apply Voucher</button>
                                </p>
                            </div>
                        </div>
                        <!--Accordion End-->
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="checkbox-form">
                    <h3>Billing Details</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Name<span class="required">*</span></label>
                                <input name="customerName" placeholder="" type="text" required>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="your-order">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-product-name">Product</th>
                                    <th class="cart-product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart_item">
                                    <td class="cart-product-name"><span id="productname"><?= $productName ?></span><strong class="product-quantity"> × 1</strong></td>
                                    <td class="cart-product-total">Rp. <span id="productprice" class="amount"><?= $productPrice ?></span></td>
                                    <input type="hidden" name="productName" value="<?= $productName ?>">
                                    <input type="hidden" name="productPrice" value="<?= $productPrice ?>">
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <th>Discount</th>
                                    <td>Rp. <span id="diskon" class="diskon">0</span></td>
                                    <input type="hidden" name="discount" value="0">
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><strong>Rp. <span id="amount" class="amount"><?= $productPrice ?></span></strong></td>
                                    <input type="hidden" name="totalAmount" value="<?= $productPrice ?>">
                                </tr>
                                <tr class="cart-subtotal">
                                    <th></th>
                                    <td><span class="text-bold" id="message"></span></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>

                    <div class="payment-method">
                        <div class="payment-accordion">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="#payment-1">
                                        <h5 class="panel-title">
                                            <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Direct Bank Transfer.
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="#payment-2">
                                        <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Cheque Payment
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="#payment-3">
                                        <h5 class="panel-title">
                                            <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                PayPal
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-button-payment">
                                <input value="Order Now!" type="submit">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout Area End-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
    $('#voucher').click(function() {
        var voucher = $('[name="voucherCode"]').val();
        if (voucher === '') {
            alert('Mohon isi voucher terlebih dahulu!')
        } else {
            var id = $('[name="productId"]').val();

            var link = '<?= base_url(); ?>';
            var base_url = link + 'checkout/applyvoucher/' + id;

            $.ajax({
                type: 'POST',
                data: {
                    voucherCode: voucher
                },
                url: base_url,
                dataType: 'json',
                success: function(response) {
                    $('#diskon').text(parseInt(response.discount));
                    $('#message').text(response.message);
                    $('#amount').text(parseInt(response.amount));
                    $('[name="totalAmount"]').val(parseInt(response.amount));
                    $('[name="discount"]').val(parseInt(response.discount));
                }
            });
        }
    });

</script>