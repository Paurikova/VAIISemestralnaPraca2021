<?php /** @var Array $data */ ?>
<div class="row webside">
    <div class="col-5 col-sm-5 col-md-3 col-lg-2">
        <div class="row">
            <?php if($data['error'] != "") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $data['error'] ?>
                </div>
            <?php } ?>
        </div>
        <div class="row myInput">
            <form class="newReading" method="post" action="?c=reading&a=addReading">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <input class="myTime" type="date" name="date" value="2021-01-01">
                    <input class="myTime" type="time" name="time" min="00:00" max="23:59" required>
                    <button class="btn btn-primary btn-md myTime">Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-8 col-lg-8">
        <div class="row">
            <canvas class="chart" id="myChart"></canvas>
            <script>
                const date = new Date;
                var element = document.getElementById('myChart');
                let xValues = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                let yValues = ["<?php if ($data['January'] <> null ) { echo $data['January'][0]->getTime(); } else { echo "0";} ?>",
                    "<?php if ($data['February'] <> null ) { echo $data['February'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['March'] <> null ) { echo $data['March'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['April'] <> null ) { echo $data['April'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['May'] <> null ) { echo $data['May'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['June'] <> null ) { echo $data['June'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['July'] <> null ) { echo $data['July'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['August'] <> null ) { echo $data['August'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['September'] <> null ) { echo $data['September'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['October'] <> null ) { echo $data['October'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['November'] <> null ) { echo $data['November'][0]->getTime();} else { echo "0"; }?>",
                    "<?php if ($data['December'] <> null ) { echo $data['December'][0]->getTime();} else { echo "0"; }?>"];
                let barColors = ["aqua","deepskyblue","greenyellow","#fbc634","lightsalmon","#e53935","yellow","darkorange","forestgreen","sienna","blue","#3d769c"];
                new Chart("myChart", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: "My reading year: " + date.getFullYear()
                        }
                    }
                });
            </script>
        </div>
    </div>
    <div class="col col-sm-0 col-md-4 col-lg-2">
        <div class="sidebar">
            <h2>News</h2>
            <?php foreach($data['news'] as $new) { ?>
                <a href="?c=news&a=new&newID=<?= $new->getId() ?> "><?= $new->getTitle() ?></a>
            <?php } ?>
        </div>
    </div>
</div>
