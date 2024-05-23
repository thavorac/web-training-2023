<template>
    weegrhtjhk
    <table class="table table-striped cust-table">
        <tr>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Qty</th>
            <th>Sub Total</th>
        </tr>
        <tbody id="list_prod_carts"></tbody>
    </table>
    <button class="btn btn-primary" type="submit">Place Order</button>
    <br />
</template>

<script setup>
console.log("HEllow world")
$(document).ready(function () {
    var productCarts = localStorage.getItem('my_product_carts');
    productCarts = JSON.parse(productCarts);
    prodcutList = '';
    grantTotal = 0;
    var tr = '';
    for (const product in productCarts) {
        productObj = productCarts[product];
        var currency = productObj.currency;
        var unitPrice = (productObj.price * productObj.qty);
        tr = '<tr>';
        tr += '<td>' + productObj.title + '</td>';
        tr += '<td>' + unitPrice + ' ' + currency + '</td>';
        tr += '<td>' + productObj.qty + '</td>';
        tr += '<td>' + unitPrice + ' ' + currency + '</td>';
        tr += '</tr>';
        if (currency === 'KHR') {
            grantTotal += (unitPrice / 4000);
        } else {
            grantTotal += unitPrice;
        }

        prodcutList += tr;
    }
    grantTotal = Math.ceil(grantTotal * 100) / 100;
    //Grant Total
    tr = '<tr>';
    tr += '<td colspan="3" style="text-align: right;">Grant Total</td>';
    tr += '<td>' + grantTotal + ' USD </td>';
    tr += '<\tr>';
    prodcutList += tr;
    $('#list_prod_carts').html(prodcutList);

});
</script>