
<div class="row wideContainer">
    <div class="col-sm-12">
        <div class="main">
            <button class="collapsible">Node editor</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col">
                        <div class="nav">
                    
                            <select class="btn margR" name="" id="">
                                <?php
                                    editorData::getTypeOption($_SESSION["simulation"]);
                                ?>
                            </select>
                            <input  class="inpt margR" type="text" placeholder="Label">
                            <button class="btn margR">add</button>
                            <button class="btn">remove</button>
                        </div>
    
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col-12">
                       
                            <button class="btn selected">N1</button>

    
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>