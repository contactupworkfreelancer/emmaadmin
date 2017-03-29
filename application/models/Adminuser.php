<?php
Class Adminuser extends CI_Model
{

 function login($emailid, $password)
 {
   //echo "email Id : ".$emailid;
   $this -> db -> select('id, username, password,email_id,type,image');
   $this -> db -> from('admin_user');
   $this -> db -> where('email_id', $emailid);
   $this -> db -> where('password', MD5($password));
   $this -> db -> where('type', 1);
   $this -> db -> limit(1);

   $query = $this -> db -> get();
      // $this->db->last_query();
      // echo "<pre> Data :".print_r($this->db->last_query() , TRUE )."</pre>";
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

 function fetchCountry()
 {
   
   $this -> db -> select('id, name');
   $this -> db -> from('countries');

   $query = $this -> db -> get();
       $this->db->last_query();
   if($query -> num_rows() > 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

 function fetchState( $countryId )
 {
   
   $this -> db -> select('id, name');
   $this -> db -> from('states');
   $this -> db -> where('country_id', $countryId);


   $query = $this -> db -> get();
       //$this->db->last_query();
     
   if($query -> num_rows() >= 1)
   {
     return $query->result_array();
   }
   else
   {
     return false;
   }
 }

 function insertCity($data){
// Inserting in Table(students) of Database(college)
    if ($this->db->insert('city', $data)) {
     return true;
    } else {
      return false;
    }
  }

  function fetchCity()
  {
    
    $this -> db -> select('city.id, city,states.name As state,countries.name As country,zipcode,status');
   $this -> db -> from('city');
   $this -> db -> join('states', 'states.id = city.state_id', 'left');
   $this -> db -> join('countries', 'countries.id = city.country_id', 'left');

   $query = $this -> db -> get();
       //echo $this->db->last_query();
       //echo $this->db->last_query();
   if($query -> num_rows() >= 1)
   {
     return $query->result_array();
   }
   else
   {
     return false;
   }
  }
   
   
   function fetchCategory()
  {
    
   $this -> db -> select('id, name,image,status');
   $this -> db -> from('category');
   
   $query = $this -> db -> get();
      
     if($query -> num_rows() >= 1)
     {
       return $query->result_array();
     }
     else
     {
       return false;
     }
  }
function insert($data){
	if ($this->db->insert('category', $data)) {
     return true;

    } else {
      return false;

    }
} 

function insertName($data){
// Inserting in Table(students) of Database(college)
  
    if ($this->db->insert('category', $data)) {
     
     return true;
    } else {
      
      return false;
    }
  }
  
  
  public function deletecity($id) { 
         if ($this->db->delete('city', "id = ".$id)) { 

         //echo $this->db->last_query();
            return true; 
         } 
      } 

	 function updatecity($user_id, $data)  
      {  
           $this->db->where("id", $user_id);  
           $this->db->update("city", $data);  
      }  

      function fetchcityData($id)
      {
       
         $this -> db -> select('id, city,state_id,country_id,zipcode,status');
         $this -> db -> from('city');
         $this -> db -> where('id', $id);
         $query = $this -> db -> get();
         //  echo  $this->db->last_query();
            // echo "<pre> Data :".print_r($this->db->last_query() , TRUE )."</pre>";
         if($query -> num_rows() == 1)
         {
           return $query->result();
         }
         else
         {
           return false;
         }
      }

}
 ?>
