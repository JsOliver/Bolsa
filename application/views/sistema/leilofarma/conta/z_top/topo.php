<div class="container my-3" style="margin-top: 48px;margin-bottom: 40px;">
    <div class="row">

        <div class="col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body text-center">
                    <img src="https://mimity-fashion51.netlify.com/img/user/user.svg" width="100" height="100" alt="User" class="rounded-circle mb-3">
                    <h5 class="bold mb-0"><?php echo $usuario['nome'];?></h5>
                    <small class="counter"><i style="color: #248029!important;" class="fa fa-circle"></i> Online Agora </small>
                    <hr style="margin-top:10px;">
                </div>
                <div class="list-group list-group-flush">
                    <a href="<?php echo base_url('minha-conta');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2) == ''): echo 'active'; endif;?> "><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="margin-top:3px; margin-bottom: -3px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-3"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Perfil</a>
                    <a href="<?php echo base_url('minha-conta/cotacoes');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2) == 'cotacoes'): echo 'active'; endif;?>"><svg xmlns="http://www.w3.org/2000/svg" style="margin-top:3px; margin-bottom: -3px;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag mr-3"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> Meus Lances</a>
                    <a href="javascript:logout();" class="list-group-item list-group-item-action text-danger "><svg style="margin-top:3px; margin-bottom: -3px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out mr-3"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Logout</a>
                </div>
            </div>
        </div>