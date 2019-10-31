<?php 
            
        $this->db->from("permissoes");
        $this->db->where("id", 4);
        $this->db->where("status", 1);
        $this->db->where("acoes", 0);
        $get = $this->db->get();
        $count = $get->num_rows();
if($count > 0):

header("Location:/");

else:

echo "Landing Page";
endif;
            
            ?>