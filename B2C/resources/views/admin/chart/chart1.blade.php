
<canvas id="newChart" width="400" height="400"></canvas>
<script>
$(function () {
    var ctx = document.getElementById("newChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["普通", "白银", "黄金", "紫金", "钻石", "至尊"],
            datasets: [{
                label: '# of Votes',
                data: [{{$member['pt']}}, {{$member['by']}},{{$member['hj']}},{{$member['zj']}},{{$member['zs']}},{{$member['zz']}}],
                backgroundColor: [
                    'rgba(187,255,255,0.8)',
                    'rgba(255, 255, 255, 0.9)',
                    'rgba(255, 255, 0, 0.8)',
                    'rgba(154,50,205, 0.8)',
                    'rgba(248, 248 ,255, 0.9)',
                    'rgba(238, 99, 99 ,0.9)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
});
</script>