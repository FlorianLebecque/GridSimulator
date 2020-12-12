<?php
    class bdd{
            //connect to the database
        static public function getBDD(){
            $server ="localhost";
            $user = "root"; 
            $password="";
            $base ="poo_elec";

            $BDD = mysqli_connect($server,$user,$password,$base);

            if(mysqli_connect_error()){
                printf("Echec à la connexion : %s\n",mysqli_connect_error()); 
                echo 'erreur de co';
                exit();
            }
            return $BDD;
        }

            //function to send a query, return the result
        static public function sendQuery($req){
            $BDD = self::getBDD();
            return mysqli_query($BDD,$req);
        }

            //format the query result into an assoc array
        static private function format($data){
            $dt = [];
            
            if(mysqli_num_rows($data)>0){
                while($temp_data = mysqli_fetch_array($data,MYSQLI_ASSOC)){
                    array_push($dt,$temp_data);
                }
            }
            return $dt;
        }

            //retreive the data base en the query ($req)
        static public function getData($req){
            $raw_data = self::sendQuery($req);
            return self::format($raw_data);
        }

        static public function setData($req){
            return self::sendQuery($req);
        }

    } 

        //class that create and return all the
    class bddQuery{
            //get all the node by type
        static function getNopeQuery_by_type($sim,$type){
            return 'SELECT node.id, node.label FROM `pe_node` node INNER JOIN `pe_type_node` tnode  ON node.id_type = tnode.id WHERE tnode.type_simple = "'.$type.'" AND node.id_sim ='.$sim;
        }
            //get all the node type by simulation
        public static function getNodeTypeQuery($sim){
            return 'SELECT tnode.`id`,tnode.label ,tnode.`type_simple`,tnode.`type`,tnode.`meta` FROM `pe_type_node` AS tnode INNER JOIN pe_sim AS sm ON tnode.`id_sim` = sm.id WHERE tnode.`id_sim` = '.$sim;
        }

        public static function getNodeTypeQuery_by_simpleType($sim,$stype){
            return 'SELECT tnode.`id`,tnode.label ,tnode.`type_simple`,tnode.`type`,tnode.`meta` FROM `pe_type_node` AS tnode INNER JOIN pe_sim AS sm ON tnode.`id_sim` = sm.id WHERE tnode.`type_simple`="'.$stype.'" and tnode.`id_sim` = '.$sim;
        }

        public static function qetTestSimNameQuery($name){
            return "SELECT `id`,`psw` FROM `pe_sim` WHERE `name` = '".$name."'";
        }

        public static function getCountSimQuery($name){
            return "SELECT count(*) as 'count' FROM `pe_sim` WHERE `name` = '".$name."'";
        }

        public static function getAddSimQuery($name,$pass){
            return 'INSERT INTO `pe_sim`(`name`, `psw`) VALUES ("'.$name.'","'.$pass.'")';
        }

        public static function getNodeTypeFieldQuery(){
            return 'SELECT * FROM `pe_type_meta_field` WHERE 1';
        }

        public static function getNodeTypeFieldQuery_by_type($type){
            return 'SELECT * FROM `pe_type_meta_field` WHERE `type` = "'.$type.'"';
        }

        public static function getAddNewNodeTypeQuery($label,$sim,$stype,$type,$meta){
            return 'INSERT INTO `pe_type_node`(`label`, `id_sim`, `type_simple`, `type`, `meta`) VALUES ("'.$label.'",'.$sim.',"'.$stype.'","'.$type.'",\''.$meta.'\')';
        }

        public static function getNodeLabelQuery($id){
            return 'SELECT `label` FROM `pe_node` WHERE `id` ='.$id;
        }

        public static function getNodeQuery($id){
            return 'SELECT node.`id`,node.`id_type`,node.`label` FROM `pe_node` AS node INNER JOIN pe_sim AS sim ON node.`id_sim` = sim.id WHERE node.`id_sim` = '.$id;
        }

        public static function getNodeChildQuery($id){
            return 'SELECT child.`id_parent`,child.`id_child`,child.`max_pwr` FROM `pe_node_children` AS child INNER JOIN pe_node AS node ON child.`id_parent` = node.id WHERE node.id_sim = '.$id;
        }

        public static function getFirstNodeQuery($id){
            return 'SELECT min(id) AS id FROM `pe_node` WHERE `id_sim` = '.$id;
        }

        public static function getLastNodeQuery($id){
            return 'SELECT max(id) AS id FROM `pe_node` WHERE `id_sim` = '.$id;
        }

        public static function InsertNodeQuery($sim,$type_id,$node_label){
            return 'INSERT INTO `pe_node`(`id_sim`, `id_type`, `label`) VALUES ('.$sim.','.$type_id.',"'.$node_label.'")';
        }

        public static function InsertChildQuery($parent_id,$node_id,$max_power){
            return 'INSERT INTO `pe_node_children`(`id_parent`, `id_child`, `max_pwr`) VALUES ('.$parent_id.','.$node_id.','.$max_power.')';
        }

        public static function getLastSimQuery($name){
            return 'SELECT max(id) AS id FROM `pe_sim` WHERE `name` = "'.$name.'"';
        }

        public static function DeleteNodeQuery($id){
            return 'DELETE FROM `pe_node` WHERE `id` = '.$id;
        }

        public static function DeleteChildQuery($id){
            return 'DELETE FROM `pe_node` WHERE `id` IN (SELECT `id_child` FROM `pe_node_children` WHERE `id_parent` = '.$id.')';
        }

        public static function rmvTypeQuery($sim,$id){
            return 'DELETE FROM `pe_type_node` WHERE `id` = '.$id.' AND `id_sim` ='.$sim;
        }
    }
?>