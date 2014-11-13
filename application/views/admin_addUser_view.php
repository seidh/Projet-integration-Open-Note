
        <div id="page-wrapper">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Ajouter un utilisateur</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10">
                        <?php // echo $error; ?>
                        <?php //echo form_open_multipart('administration/adduser')?>
                        <div class="form-group row">
                            <div class="col-lg-3 text-right top5">
                                <label>Nom :</label>
                            </div>
                            <div class="col-lg-5">
                                <input id="name" name="name" class="form-control" />
                            </div>                          
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 text-right top5">
                                <label>Prénom :</label>
                            </div>
                            <div class="col-lg-5">
                                <input id="firstname" name="firstname" class="form-control" />
                            </div>                                     
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 text-right top5">
                                <label>Email :</label>
                            </div>
                            <div class="col-lg-5">
                                <input id="email" name="email" class="form-control" />
                            </div>                                     
                        </div>  
                        <div class="form-group row">
                            <div class="col-lg-3 text-right top5">
                                <label>Groupe :</label>
                            </div>
                            <div class="col-lg-5">
                                <input id="group" name="group" class="form-control" />
                            </div>                                     
                        </div>   
                        <div class="form-group row">
                            <div class="col-lg-3 text-right top5">
                                <label>Date de naissance :</label>
                            </div>
                            <div class="col-lg-1">
                                <input id="dayBirth" name="dayBirth" class="form-control" />
                            </div>
                            <div class="col-lg-1">
                                <input id="monthBirth" name="monthBirth" class="form-control" /> 
                            </div> 
                            <div class="col-lg-2">
                                <input id="yearBirth" name="yearBirth" class="form-control" />
                            </div>                            
                        </div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2 top10">
                        <button class="btn btn-primary btn-lg btn-block" >Effectuer l'ajout</button>
                    </div>

                    <div class="col-lg-2 top10">
                        <button class="btn btn-primary btn-lg btn-block">Reset</button>
                    </div>
                </div>
                                
                <!-- /.col-lg-12 -->
            </div>


        </div>
        <!-- /#page-wrapper -->

    