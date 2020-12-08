
<div class="row wideContainer">
    <div class="col-sm-12">
        <div class="main">
            <div class="row">
                <h2 class="col">Power</h2>
            </div>
            <hr>
            <div class="row">
                <?php
                    graphArray::createGraphArray("p","power");
                ?>
            </div> 
        </div>
        <div class="main">
            <div class="row">
                <h2 class="col">CO2</h2>
            </div>
            <hr>
            <div class="row">
                <?php
                    graphArray::createGraphArray("p","CO2");
                ?>
            </div> 
        </div>
    </div>
</div>