function createTreantJs(nodeArray,divId){
    
    let simple_chart_config = {
        chart: {
            container: divId,
            
            node: {
                collapsable: false,
                HTMLclass:["btn"]
            },
            connectors: {
                type: "step",
                style: {
                    'stroke': '#FF5555'
                }
            },
            
        },
        
        nodeStructure: createNodeStructure(nodeArray,0)
    };

    return my_chart = new Treant(simple_chart_config);
}

function createNodeStructure(node){

    let temp_array = {
        text:{
            name: node["label"]
        },
        collapsable:false,
        link:{href:"javascript:nodeClick('"+node["id"]+"');"},
        HTMLid:node["id"],
        children:[]
    }

    node["child"].forEach(function(childNode){
        temp_array["children"].push(createNodeStructure(childNode));
    });

    return temp_array;
}

function  getNode(node,id) {

    if(node["id"]==id){
        return node
    }else{
        let temp_node = []
        let corNode = [];
        
        node["child"].forEach(function(childNode){

            
            temp_node = getNode(childNode,id)
            if(temp_node["id"] == id){
                corNode = temp_node;
            }

        });
        return corNode;
    }
}