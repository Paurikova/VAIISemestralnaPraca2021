<?php /** @var Array $data */ ?>
<div class="row webside">
    <div class="col-5 col-sm-5 col-md-3 col-lg-2">
        <div class="row myInput">
            <form class="newReading" method="post" action="?c=reading&a=addReading">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <input class="myTime" id="date" type="date" name="date" value="2021-01-01">
                    <input class="myTime" id="time" type="time" name="time" min="00:00" max="23:59" required>
                    <!--<button class="btn btn-primary btn-md myTime">Add</button>-->
                    <button id="newReading" class="btn btn-primary btn-md myTime">Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-10 col-lg-10">
        <div class="row">
            <div class="chart" id="myChart"></div>
        </div>
    </div>
</div>
