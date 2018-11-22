function haha(o)
{
    var aid = o.target;
    $('#'+aid).val(o.name);
    // 提交表单
    $('#spus').submit();
}
// 购物车 js
$('#add').click(function(){
    var spu_num = $('#all_num').val();
    var val = $('#num').val();
    if(val*1 <= spu_num*1){
        $('#num').val(val*1+1);
    } 
});
$('#delete').click(function(){
    var val = $('#num').val();
    if(val*1 > 1){
        $('#num').val(val*1-1);
    } 
});
$('#num').change(function(){
    var val = $(this).val();
    var spu_num = $('#all_num').val();
    if(val > spu_num )
    {
        $(this).val(1);
    }
    if(val < 1)
    {
        $(this).val(1);  
    }
    if(val*1-val*1 != 0)
    {
        $(this).val(1);   
    }
});

// 如果商品卖光了
if((!$('#all_num').val()) || ($('#all_num').val()*1 == 0)){
    $('#sub').attr('disabled',true);
}