<?php
require_once "crud.php";
require_once "config.php";

//création de la date_time Student
class todo implements CRUD
{
    //Proprietés privées
    private $conn;
    public $libelle;
    public $date_time;
    public $description;
    public $date_echeance;
    public $checked;
    public $priorite;
    public $etat;


    //creation de la methode construct
    public function __construct($conn,$libelle,$date_time,$description,$date_echeance,$checked,$priorite,$etat)
    {
        $this->conn=$conn;
        $this->libelle=$libelle;
        $this->date_time=$date_time;
        $this->description=$description;
        $this->date_echeance=$date_echeance;
        $this->checked=$checked;
        $this->priorite=$priorite;
        $this->etat=$etat;

        

    }
   

    //Methode pour ajouter des élèves
    public function addTodo($conn,$libelle,$date_time,$description,$date_echeance,$checked,$priorite,$etat)
    {
        try {
            //requete pour inserer

    $sql= "INSERT INTO todos(libelle, description, date_echeance, priorite, etat) VALUES(?, ?, ?, ?, ?)";

            //preparation de la requete
            $stmt=$this->conn->prepare($sql);

             //faire la liaison des valeurs aux paremètre
             $stmt->bindParam(':libelle',$libelle, PDO::PARAM_STR);
             $stmt->bindParam(':date_time',$date_time, PDO::PARAM_STR);
             $stmt->bindParam(':description',$description, PDO::PARAM_INT);
             $stmt->bindParam(':libelle',$date_echeance, PDO::PARAM_STR);
             $stmt->bindParam(':libelle',$checked, PDO::PARAM_STR);
             $stmt->bindParam(':libelle',$priorite, PDO::PARAM_STR);
             $stmt->bindParam(':libelle',$etat, PDO::PARAM_STR);


             //execute la requete

             $stmt->execute();

             //rediriger la page 
             header("location: todolist.php");
             exit();


        } catch (PDOException $e) {
            die("erreur: impossible d'inserer des données" .$e->getMessage());
        }
    }


    //Methode pour afficher les élèves
    public function readTodo($id)
    {
        try {
            //requete sql pour selectionner tout les élèves
            $sql="SELECT * FROM todos";

            //preparation de la requete
            $stmt=$this->conn->prepare($sql);

            //exécution de la requete
            $stmt->execute();

            //recuperation des resultats
            $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        } 
        catch (PDOException $e) {
            die("erreur:Impossible d'afficher les élèves" .$e->getMessage());
        }
    }
    
//methode pour checker une tache

public function checkedTodo($id, $libelle, $date_time, $description, $date_echeance, $checked, $priorite, $etat)
{

if(isset($_GET['id'])){
    require_once 'config.php';

    $id = $_GET['id'];

    // if(empty($id)){
    //    echo 'error';
    //    exit();
    // } else {
        $stmt = $conn->prepare("UPDATE todos SET checked =1 WHERE id = ?");

        //$stmt = $conn->prepare("UPDATE todos SET checked = CASE WHEN checked = 0 THEN 1 ELSE 0 END WHERE id = ?");
        $res = $stmt->execute([$id]);

        if($res){
            header("Location:todolist.php?mess=succes");
        } else {
            echo "error";
        }
        $conn = null;
        exit();
    }
 else {
    header("Location:todolist.php?mess=error");
}
    
}
//Methode pour modifier des taches
public function updateTodo($conn,$libelle,$date_time,$description,$date_echeance,$checked,$priorite,$etat)
{
    try {
        //requete pour inserer

        $sql= "UPDATE todos SET libelle= :libelle, description = :description, date_echeance = :date_echeance, priorite = :priorite, etat = :etat WHERE id = :id";
        //preparation de la requete
        $stmt=$this->conn->prepare($sql);

         //faire la liaison des valeurs aux paremètre
         $stmt->bindParam(':libelle',$libelle, PDO::PARAM_STR);
         $stmt->bindParam(':date_time',$date_time, PDO::PARAM_STR);
         $stmt->bindParam(':description',$description, PDO::PARAM_INT);
         $stmt->bindParam(':libelle',$date_echeance, PDO::PARAM_STR);
         $stmt->bindParam(':libelle',$checked, PDO::PARAM_STR);
         $stmt->bindParam(':libelle',$priorite, PDO::PARAM_STR);
         $stmt->bindParam(':libelle',$etat, PDO::PARAM_STR);


         //execute la requete

         $stmt->execute();

         //rediriger la page 
         echo "Avant redirection";

         header("location: todolist.php");
         exit();


    } catch (PDOException $e) {
        die("erreur: impossible d'inserer des données" .$e->getMessage());
    }
}
    //methode pour supprimer les élèves

    public function removeTodo($id)
    {
        if(isset($_GET['id'])){
            require_once 'config.php';
        
            $id = $_GET['id'];
        
            if(empty($id)){
               echo 0;
            }else {
                $stmt = $conn->prepare("DELETE FROM todos WHERE id=?");
                $res = $stmt->execute([$id]);
        
                if($res){
                    header("Location:todolist.php?mess=succes");
                }else {
                    echo 0;
                }
                $conn = null;
                exit();
            }
        }else {
            header("Location: todolist.php?mess=error");
    }
}

}