<?php

    class USER{
        //déclaration des attributs
        private $id_user;
        private $nom_u;
        private $prenom_u;
        private $mail_u;
        private $avatar;
        private $date_naissance_u;
        private $password_u;

        
        public function id_user(){return $this->id_user;}
        public function nom_u(){return $this->nom_u;}
        public function prenom_u(){return $this->prenom_u;}
        public function mail_u(){return $this->mail_u;}
        public function avatar(){return $this->avatar;}
        public function date_naissance_u(){return $this->date_naissance_u;}
        public function password_u(){return $this->password_u;} 
        
        //déclaration des Setter
        public function setId_user($id){
            $this->id_user=(int) $id;
        }
        public function setNom_u($name){
            $this->nom_u=$name;
        }
        public function setPrenom_u($surname){
            $this->prenom_u=$surname;
        }
        public function setMail_u($mail){
            $this->mail_u=$mail;
        }
        public function setAvatar($avat){
            $this->avatar=$avat;
        }
        public function setDate_naissance_u($date){
            $this->date_naissance_u=$date;
        }
        public function setPassword_u($password_u){
            $this->password_u=$password_u;
        }

        //HYDRATATION
        public function hydrate( array $donnees){
            foreach($donnees as $key => $value){
                $method='set'.ucfirst($key);// ucfirst mettra la premiere lettre en majuscule
                if(method_exists($this,$method)){
                    $this->$method($value);
                }
            }
        }
    }

    class UserManager{
        private $bdd;

        public function setDb(PDO $bdd){
            $this->bdd=$bdd;
        }

        //à l'initialisation de mon manager je lui donne la connexion à la BdD
        public function __construct($bdd){
            $this->setDb($bdd);
        }

        public function add(User $user){
            //on utilise l'objet $bdd de PDO et on utilise sa méthode prepare
            //on donne un nom à chacun des champs qui vont varier ":pseudo"
            $req=$this->bdd->prepare('INSERT INTO utilisateur (nom_u, prenom_u, mail_u, date_naissance_u, password_u) VALUES(:nom_u, :prenom_u, :mail_u, :date_naissance_u, :password_u)');
            
            $req->bindValue(':nom_u', $user->nom_u(),PDO::PARAM_STR);
            $req->bindValue(':prenom_u', $user->prenom_u(),PDO::PARAM_STR);
            $req->bindValue(':mail_u',$user->mail_u());
            $req->bindValue(':date_naissance_u',$user->date_naissance_u(),PDO::PARAM_STR);
            $req->bindValue(':password_u',$user->password_u(),PDO::PARAM_STR);

            $req->execute();
        }

        public function delete(User $user){
            /*  l'instruction delete ne permet pas d'injection SQL   */
            $this->bdd->exec('DELETE FROM utilisateur WHERE id_user='.$user->id_user());
            /*            |->exec() est la méthode de PDO quand on exécute une commande ne retournant aucun résultat  */
        }
        public function get($id){
            // je m'assure due id est bien un entier
            $id = (int) $id;

            $req = $this->bdd->prepare('SELECT * FROM utilisateur WHERE id_user = ?');
            $req->execute(array($id));
            //PDO::FETCH_ASSOC retourne un tableau associatif indexé par le nom des champs
            $donnees=$req->fetch(PDO::FETCH_ASSOC);
            
            //je crée un nouvel objet user
            $user = new User();
            //je l'hydrate et je le retourne en résultat de ma méthode
            $user->hydrate($donnees);
            return $user;
        }
        public function getAll(){
            //j'initialise un tableau vide qui contiendra l'ensemble de mes users
            $users = [];

            $req = $this->bdd->query('SELECT * FROM utilisateur');

            while($donnees = $req->fetch(PDO::FETCH_ASSOC)){
                $user = new User();
                $user->hydrate($donnees);
                $users[] = $user;

            }
            return $users;
        }
        public function update(User $user){
            $req = $this->bdd->prepare('UPDATE utilisateur SET nom_u = :nom_u, prenom_u = :prenom_u, mail_u = :mail_u, avatar = :avatar, date_naissance_u = :date_naissance_u, password_u = :password_u WHERE id_user = :id_user');

            $req->bindValue(':id_user', $user->id_user(),PDO::PARAM_INT);
            $req->bindValue(':nom_u', $user->nom_u(),PDO::PARAM_STR);
            $req->bindValue(':prenom_u', $user->prenom_u(),PDO::PARAM_STR);
            $req->bindValue(':mail_u',$user->mail_u());
            $req->bindValue(':avatar',$user->avatar());
            $req->bindValue(':date_naissance_u', $user->date_naissance_u());
            $req->bindValue(':password_u',$user->password_u(),PDO::PARAM_STR);

            $req->execute();

        }
        public function login($email){
            $req = $this->bdd->prepare('SELECT * FROM utilisateur WHERE mail_u =?');
            $req->execute(array($email));
            if($donnees = $req->fetch(PDO::FETCH_ASSOC)){
                $user = new USER();
                $user->hydrate($donnees);
                return $user;
            }else{
                return false;
            }
        }
    }
?>