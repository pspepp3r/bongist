<div class="cart">
    <div class="cart-wrapper">
        <div class="cart-header text-center">
            <div class="row">
                <div class="col-6">Item</div>
                <div class="col-2">Price</div>
                <div class="col-2">Quantity</div>
                <div class="col-2">Total</div>
            </div>
        </div>
        <div class="cart-body">
            <?php
            $items = order::details($order_id);

            foreach ($items as $item) {
                ?>
            <!-- Product-->
            <div class="cart-item">
                <div class="row d-flex align-items-center text-center">
                    <div class="col-6">
                        <div class="d-flex align-items-center"><a href="shop/product/<?php echo $item['slug']; ?>" target="_blank"><img src="<?php echo config::baseUploadProductUrl().$item['thumbnail']; ?>" alt="<?php echo $item['name']; ?>" class="cart-item-img"></a>
                            <div class="cart-title text-left"><a href="shop/product/<?php echo $item['slug']; ?>" target="_blank" class="text-uppercase text-dark"><strong><?php echo $item['name']; ?></strong></a><br><span class="text-muted text-sm">Size: <?php echo $item['size']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">₦<?php echo number_format($item['unit']); ?></div>
                    <div class="col-2"><?php echo number_format($item['qty']); ?>
                    </div>
                    <div class="col-2 text-center">₦<?php echo number_format($item['total']); ?></div>
                </div>
            </div>
            <?php
            }

            ?>

        </div>
    </div>
</div>
<div class="row my-5">
    <div class="col-md-6">
        <div class="block mb-5">
            <div class="block-header">
                <h6 class="text-uppercase mb-0">Order Summary</h6>
            </div>
            <div class="block-body bg-light pt-1">
                <p class="text-sm">Shipping and additional costs are calculated based on delivery location.</p>
                <ul class="order-summary mb-0 list-unstyled">
                    <li class="order-summary-item"><span>Order Subtotal </span><span>₦<?php echo number_format($order['total']); ?></span></li>
                    <li class="order-summary-item"><span>Shipping and handling</span><span>₦<?php echo number_format($order['delivery_cost']); ?></span></li>
                    <li class="order-summary-item"><span>Tax</span><span>₦0</span></li>
                    <li class="order-summary-item border-0"><span>Total</span><strong class="order-summary-total">₦<?php echo number_format($order['total']); ?></strong></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="block-header">
            <h6 class="text-uppercase mb-0">Invoice address</h6>
        </div>
        <div class="block-body bg-light pt-1">
            <p>
                <?php echo $account['fname'].' '.$account['lname']; ?><br>
                <strong><?php echo $account['country']; ?>,</strong><br>
                <?php echo $account['state'].', '.$account['city']; ?><br>
                <?php echo $account['address']; ?>
            </p>
        </div>
    </div>
</div>