<?php
    class bdd{
            //connect to the database
        static private function getBDD(){
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

            //function to send a querry, return the result
        static private function sendQuerry($req){
            $BDD = self::getBDD();
            return mysqli_query($BDD,$req);
        }

            //format the querry result into an assoc array
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
            $raw_data = self::sendQuerry($req);
            return self::format($raw_data);
        }
    } 

        //class that create and return all the
    class bddQuerry{
            //get all the node by type
        static function getNopeQuerry_by_type($sim,$type){
            return 'SELECT node.id, node.label FROM `pe_node` node INNER JOIN `pe_type_node` tnode  ON node.id_type = tnode.id WHERE tnode.type_simple = "'.$type.'" AND node.id_sim ='.$sim;
        }
    }

?>