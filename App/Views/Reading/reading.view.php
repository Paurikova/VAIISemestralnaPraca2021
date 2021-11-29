<?php /** @var Array $data */ ?>
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
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <canvas id="myChart"></canvas>
            </div>
        </form>
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