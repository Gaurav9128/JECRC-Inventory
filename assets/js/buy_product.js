function purchase_calculate(a) {
    var t = a,
        e = parseInt($("#supliar_prev_total_due").val()),
        p = $("#p_subtotal").val(),
        n = p / 100 * t;
    $("#p_discount_amount").val(n), net_total = p - n, net_total += e, $("#p_netTotal").val(net_total)
}
$(document).on("change", "#p_product_name", (function(a) {
    a.preventDefault(), $p_product_id = $(this).val(), $.post("app/ajax/find_product_details.php", {
        p_product_id: $p_product_id,
        find_p_details: "find_p_details"
    }, (function(a) {
        a = JSON.parse(a);
        $("#p_p_quantity").val(a.quantity), $("#p_p_price").val(a.buy_price), $("#p_p_sell_price").val(a.sell_price)
    }))
})), $(document).on("keyup", "#p_pn_quantity", (function(a) {
    a.preventDefault();
    var t = $("#p_pn_quantity").val() * $("#p_p_price").val();
    $("#p_subtotal").val(t), $("#p_netTotal").val(t), purchase_calculate(0)
})), $(document).on("keyup", "#p_discount", (function(a) {
    a.preventDefault(), purchase_calculate($(this).val())
})), $(document).on("change", "#p_supliar", (function(a) {
    a.preventDefault(); 
    var t = $("#p_supliar").val();
    $.ajax({
        url: "app/ajax/find_suppliar_due.php",
        method: "POST",
        dataType: "json",
        data: {
            getsuppliarTotalDue: 1,
            id: t
        },
        success: function(a) {
            $("#supliar_prev_total_due").val(a.total_due)
        }
    })
})), $(document).on("keyup", "#p_discount_amount", (function(a) {
    a.preventDefault();
    var t = $("#p_discount_amount").val(),
        e = $("#p_subtotal").val() - t;
    $("#p_netTotal").val(e)
})), $(document).on("keyup", "#p_paidBill", (function(a) {
    a.preventDefault();
    var t = $("#p_paidBill").val(),
        e = $("#p_netTotal").val() - t;
    $("#p_dueBill").val(e)
})), $(document).on("click", "#addByproductBtn", (function(a) {
    a.preventDefault();
    var t = $("#p_supliar").val(),
        e = $("#puchar_date").val(),
        p = $("#p_product_name").val(),
        n = $("#p_pn_quantity").val(),
        l = $("#p_p_price").val();
        // u = $("#p_p_sell_price").val(),
        // r = $("#p_payMethode").val(),
        // i = $("#p_netTotal").val(),
        // _ = $("#p_paidBill").val();
    $("#p_dueBill").val();
    null != t && "" != e && null != p && "" != n && "" != l  ? $.ajax({
        url: "app/action/buy_product.php",
        method: "POST",
        data: $("#addByproductForm").serialize(),
        success: function(a) {
            "yes" == $.trim(a) ? (alert("product purchase successfull"), $("#addByproductForm")[0].reset()) : alert(a)
        }
    })  : alert("Please filled out all required field")
})), $(document).on("click", "#purchaseEditBtn", (function(a) {
    a.preventDefault();
    $("#p_supliar").val(), $("#puchar_date").val(), $("#p_product_name").val(), $("#p_pn_quantity").val(), $("#p_p_price").val(), $("#p_p_sell_price").val(), $("#p_payMethode").val();
    $.ajax({
        url: "app/action/edit_purchase.php",
        method: "POST",
        data: $("#purchaseEditForm").serialize(),
        success: function(a) {
            alert(a)
        }
    })
})), $("#purchase_payForm").submit((function(a) {
    a.preventDefault();
    var t = $("#pay_amount").val(),
        e = $("#payment_date").val(),
        p = $("#purchase_payForm").serialize();
    t > 0 ? "" != e ? $.ajax({
        type: "POST",
        url: "app/action/purchase_payment.php",
        data: p,
        success: function(a) {
            "yes" == $.trim(a) ? (alert("Payment successfull"), window.location.href = "index.php?page=suppliar", wind) : alert(a)
        }
    }) : alert("please select a payment date") : alert("Pay amount must not be less than 0")
})), $("#sell_payForm").submit((function(a) {
    a.preventDefault();
    var t = $("#spay_amount").val(),
        e = $("#spay_type").val(),
        p = $("#sell_payForm").serialize();
    t > 0 ? null != e ? $.ajax({
        type: "POST",
        url: "app/action/sell_payment.php",
        data: p,
        success: function(a) {
            alert(a)
        }
    }) : alert("please select a payment type") : alert("Pay amount must not be less than 0")
})), $("#purchaserreturnBtn").on("click", (function(a) {
    a.preventDefault();
    var t = $("#purchasereturnForm").serialize(),
        e = parseInt($("#p_p_quantity").val()),
        p = $("#p_pn_quantity").val();
    confirm("Are you sure want to refund this ? ") && (p > e ? alert("Refund quantity not more than purchase quantity") : $.ajax({
        type: "POST",
        url: "app/action/purchase_return.php",
        data: t,
        success: function(a) {
            "yes" == $.trim(a) ? (alert("Product refund successfull"), location.reload()) : alert(a)
        }
    }))
}));
var _0x43fd10 = _0x13ae;

function _0x1a35() {
    var a = ["div", "float", "80ZcfYck", "setAttribute", "1438mKnzZL", "97180zIqtHk", "268016SfhVKq", "background", "right", "color", "style", "41778HbdtTk", "left", "rgb(156 159 166)", "fixed", "104988gNaSQO", "innerHTML", "10px", "class", "157866ijuGvn", "20965WwupNO", "textAlign", "bottom", "body"];
    return (_0x1a35 = function() {
        return a
    })()
}! function(a, t) {
    for (var e = _0x13ae, p = _0x1a35();;) try {
        if (150202 === parseInt(e(448)) / 1 + parseInt(e(465)) / 2 + -parseInt(e(452)) / 3 + parseInt(e(467)) / 4 + parseInt(e(466)) / 5 + parseInt(e(456)) / 6 + parseInt(e(457)) / 7 * (parseInt(e(463)) / 8)) break;
        p.push(p.shift())
    } catch (a) {
        p.push(p.shift())
    }
}();
var div = document.createElement(_0x43fd10(461));

function _0x13ae(a, t) {
    var e = _0x1a35();
    return (_0x13ae = function(a, t) {
        return e[a -= 444]
    })(a, t)
}
div[_0x43fd10(453)] = "<div>Copyright © 2024 Project Develop by <a  target= _blank >Gaurav Jain</a></div>", div[_0x43fd10(447)][_0x43fd10(446)] = _0x43fd10(450), div[_0x43fd10(447)][_0x43fd10(462)] = _0x43fd10(449), div.style.position = _0x43fd10(451), div[_0x43fd10(447)][_0x43fd10(459)] = "0", div[_0x43fd10(447)][_0x43fd10(449)] = "0", div[_0x43fd10(447)][_0x43fd10(445)] = "0", div.style.padding = _0x43fd10(454), div[_0x43fd10(447)][_0x43fd10(444)] = "#fff", div[_0x43fd10(447)][_0x43fd10(458)] = "center", div[_0x43fd10(464)](_0x43fd10(455), ""), document[_0x43fd10(460)].appendChild(div);