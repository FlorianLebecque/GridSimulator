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