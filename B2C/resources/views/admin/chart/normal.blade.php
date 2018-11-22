<style>
    .chart_normal{
        display: inline-block;
        width: 200px;
        height: 100px;
        margin-left: 60px;
        text-align: center;
        line-height: 100px;
        font-size: 20px;
        background-color: skyblue;
        color: #7A7A7A;
    }
</style>
<div class="chart_normal">
    <span>交易金额:{{$data['All_money']}}</span>
</div>
<div class="chart_normal">
    <span>订单总数:{{$data['All_order']}}</span>
</div>
<div class="chart_normal">
    <span>成功订单:{{$data['All_succe']}}</span>
</div>
<div class="chart_normal">
    <span>失败订单:{{$data['All_error']}}</span>
</div>
<div class="chart_normal">
    <span>退款金额:{{$data['All_ermon']}}</span>
</div>