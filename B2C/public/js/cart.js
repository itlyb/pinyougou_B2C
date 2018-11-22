// 增加商品数量
function add_num(o)
{
    var name = o.name;
    var price = o.target;
    var val = $('#'+name+"_num").val();
    $('#'+name+"_num").val(val*1+1);
    ajax(name,'add',price)
    $("#"+name+"_sum").html(price*(val*1+1));
    var check =  document.getElementById(name+"_check");
    if(check.checked == true)
    {
        var html = $('.summoney').html(); 
         $('.summoney').html(html*1+price*1)
    }
}
// 减少商品数量
function delete_num(o)
{
    var name = o.name;
    var price = o.target;
    var val = $('#'+name+"_num").val();
    if(val*1 > 1){
        $('#'+name+"_num").val(val*1-1);
        ajax(name,'delete',price)
        $("#"+name+"_sum").html(price*(val*1-1));
        var check =  document.getElementById(name+"_check");
        if(check.checked == true)
        {
            var html = $('.summoney').html(); 
            $('.summoney').html(html*1-price*1)
        }
    }
}
// 如果数量变化
$('.itxt').change(function(){
    var val = $(this).val();

    var name = $(this).attr('id');
    var id = name.split('_')[0];
    var price = $(this).attr('target');
    $('#'+id+"_sum").html(val*1*price);


    if(val < 1)
    {
        $(this).val(1);  
        $('#'+id+"_sum").html(1*price);
        ajax(id,'any',price,1);
        var check =  document.getElementById(id+"_check");
        if(check.checked == true)
        {   
            var goods=document.getElementsByName("good_carts");
            var sums=document.getElementsByName("sums");
            var money = 0;
            for ( var i=0; i<goods.length; i++) {
                if(goods[i].checked == true){
                    money += sums[i].innerText*1;
                }  
            }
            $('.summoney').html(money);
            
        }
    }
    else if(val*1-val*1 != 0)
    {
        $(this).val(1); 
        $('#'+id+"_sum").html(1*price);
        ajax(id,'any',price,1); 
        var check =  document.getElementById(id+"_check");
        if(check.checked == true)
        {   
            var goods=document.getElementsByName("good_carts");
            var sums=document.getElementsByName("sums");
            var money = 0;
            for ( var i=0; i<goods.length; i++) {
                if(goods[i].checked == true){
                    money += sums[i].innerText*1;
                }  
            }
            $('.summoney').html(money);
            
        } 
    }
    else
    {
        $('#'+id+"_sum").html(val*1*price); 
        ajax(id,'any',val*1*price,val);
        var check =  document.getElementById(id+"_check");
        if(check.checked == true)
        {   
            var goods=document.getElementsByName("good_carts");
            var sums=document.getElementsByName("sums");
            var money = 0;
            for ( var i=0; i<goods.length; i++) {
                if(goods[i].checked == true){
                    money += sums[i].innerText*1;
                }  
            }
            $('.summoney').html(money);
            
        }
    }
});
// ajax 后台更改购物车状态
function ajax(id,type,money,num="")
{
    $.ajax({
        url: "/good_cart_ajax?id="+id+"&type="+type+"&money="+money+"&num="+num,
        type: "GET",
        dataType: "json",
        success: function (data)
        {
            // console.log(data);
        }
    })
}
// 全选 反选
window.onload=function(){

    var selAll=document.getElementById("selAll");
    var goods=document.getElementsByName("good_carts[]");
    var sums=document.getElementsByName("sums");

    //全选事件
    selAll.onclick=function(){
        if(selAll.checked == true){
            for ( var i=0; i<goods.length; i++) {
                goods[i].checked=true;
            }
            var money = 0;
            for ( var i=0; i<sums.length; i++) {
                money += sums[i].innerText*1;
            }
            $('.summoney').html(money);
        }else{
            for ( var i=0; i<goods.length; i++) {
                goods[i].checked=false;
            }
            $('.summoney').html('0.00');
        }
        good_num();
    }
}

// 单选
function check(o)
{
    if(o.checked == true)
    {
        var id = o.id.split('_')[0];
        var money = $('#'+id+"_sum").html();
        var all_money = $('.summoney').html()*1;
        $('.summoney').html(all_money*1+money*1);
    }
    else
    {
        var id = o.id.split('_')[0];
        var money = $('#'+id+"_sum").html();
        var all_money = $('.summoney').html()*1;
        $('.summoney').html(all_money*1-money*1);
    }
    good_num();
}

// 计算选择商品数量
function good_num()
{
    var goods=document.getElementsByName("good_carts[]");
    // var sums=document.getElementsByName("sums");
    var sum = 0;
    for(var i=0;i<goods.length;i++)
    {
        if(goods[i].checked == true)
        {
            sum += 1;
        }
    }
    $('#good_num').html(sum);
}

function sum_money()
{
    $('#carts').submit();
}

function delete_cart(o)
{ 
    var name = o.name;
    $('#'+'delete_'+name).submit();
}