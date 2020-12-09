
<script>
    let array_DataTypeField = <?php echo json_encode(editorData::getTypeField()); ?>
</script>

<div class="wideContainer">
    <div class="row main">
        <div class="col-sm-12"> 
            <button class="collapsible">Node grid</button>
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

    <div class="row main">
        <div class="col-sm-12"> 
            <button class="collapsible">Type : production</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col">
                        <form method="post" action="index.php?a=addNodeType">
                            <div class="row">
                                <div class="col">
                                    <select class="btn margR" name="nodeType" id="prd_nodeType" value="Select type">
                                    
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="nodeLabel" class="inpt" placeholder="Label">
                                </div>
                            </div><hr>
                            <div class="row minheight main">
                                <div id="prd_editor_prd_nodeType" class="col">


                                </div>
                            </div><hr>
                            <div class="row">
                                <div class="col">
                                    <input class="btn margR" type="submit" value="Create">
                                </div>
                            </div>
                        </form>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                
                                <th scope="col">Label</th>
                                <th scope="col">Meta</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    editorData::get_TypeTable($_SESSION["simulation"],"p");
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>  
        </div>
    </div>

    <div class="row main">
        <div class="col-sm-12"> 
            <button class="collapsible">Type : consumption</button>
            <div class="collasibleContent"><hr>
            <div class="row">
                    <div class="col">
                        <form method="post" action="index.php?a=addNodeType">
                            <div class="row">
                                <div class="col">
                                    <select class="btn margR" name="nodeType" id="cns_nodeType" value="Select type">
                                    
                                    </select>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="nodeLabel" class="inpt" placeholder="Label">
                                </div>
                            </div><hr>
                            <div class="row minheight main">
                                <div id="cns_editor_cns_nodeType" class="col">


                                </div>
                            </div><hr>
                            <div class="row">
                                <div class="col">
                                    <input class="btn margR" type="submit" value="Create">
                                </div>
                            </div>
                        </form>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                
                                <th scope="col">Label</th>
                                <th scope="col">Meta</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    editorData::get_TypeTable($_SESSION["simulation"],"c");
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>  
        </div>
    </div>

</div>