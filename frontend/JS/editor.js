//fill the node type in the correct select
$("#prd_nodeType").html(setType_option(array_DataTypeField, "p"))
$("#cns_nodeType").html(setType_option(array_DataTypeField, "c"))
$("#prd_nodeType").change(array_DataTypeField,get_form_field);
$("#cns_nodeType").change(array_DataTypeField,get_form_field);

function setType_option(array_DataTypeField, simple_type){
    let html = "";
    
    for(let i = 0; i < array_DataTypeField.length;i++){
        if(array_DataTypeField[i]["simple_type"] == simple_type){
            html += "<option value='"+array_DataTypeField[i]["type"]+"'>"+ array_DataTypeField[i]["label"] +"</option>";
        }
    }

    return html;
}

function getDataTypeFiled_by_type(target_type,array_DataTypeField){

    for(let i = 0; i < array_DataTypeField.length;i++){
        if(array_DataTypeField[i]["type"] == target_type){
            return array_DataTypeField[i];
        }
    }
    return -1;
}

function get_form_field(event){

    nodeTypeField = getDataTypeFiled_by_type(this.value,event.data)
    field = JSON.parse(nodeTypeField["field"])

    html = "";

    for(let i = 0; i < field.length;i++){
        
        html += "<input type='text' class='inpt margR' name='"+field[i][0]+"' placeholder='"+field[i][0]+" : ("+field[i][1]+")'>";
        
    }

    if(this.id[0]=="p"){
        $("#prd_editor_"+this.id).html(html);
    }else{
        $("#cns_editor_"+this.id).html(html);
    }

}

function rmvType(sim,typeID){

    if(confirm("This action will remove a type and all the node associeted")){
        let param = sim+"_"+typeID;
        ajaxHandler.sendRequest("rmvType",param,reload)
    }

}

//--------------------------------------------------------------------------------------

chart = createTreantJs(nodeArray,"#tree-simple")
$("#"+selectedNode["id"]).css("background-color", "var(--Accent)");
$("#btn_rmv").hide();






function nodeClick(params) {

    $("#"+selectedNode["id"]).css("background-color", "var(--Accent)");

    selectedNode = getNode(nodeArray,params)

    $("#"+params).css("background-color", "var(--Selected)");

    if(selectedNode["type"] != "n"){
        $("#btn_add").hide();
        $("#btn_rmv").show();
    }else{
        $("#btn_add").show();

        if(selectedNode["label"]=="N1"){
            $("#btn_rmv").hide();
        }else{
            $("#btn_rmv").show();
        }

    }

    $("#selectedNodeLabel").text(selectedNode["label"])
}

function addNode(sim) {
    let parentID = selectedNode["id"];
    let label = $("#node_label").val();
    let typeId = $("#node_typeID").val();
    let max_pow = $("#node_power").val();

    if(label != ""){
        let param = sim+"_"+parentID+"_"+typeId+"_"+label+"_"+max_pow;
        ajaxHandler.sendRequest("addNewNode",param,UpdatePage)
    }
}

function  rmvNode(sim) {
    let nodeId = selectedNode["id"];

    if(confirm("You are going to delete a node and all of it children, THERE IS NO GOING BACK ?")){
        ajaxHandler.sendRequest("rmvNode",sim+"_"+nodeId,UpdatePage)
    }
}

function UpdatePage(params) {
    nodeArray = JSON.parse(params);
    chart = createTreantJs(nodeArray,"#tree-simple")
}

function reload(){
    location.reload();
}