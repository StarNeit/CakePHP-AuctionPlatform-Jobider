<section id="main-content" class="">
    <section class="wrapper">
        
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Manage Client Recources Page Content</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Clientrecource', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'home', 'action' => 'Client_recources/1')));
                            ?>
                       
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control','id' => 'exampleInputPassword1n', 'value'=>$result['Clientrecource']['name'],'label' => false,'required'=>false)); ?>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Title</label>
                                <?php echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control','id' => 'exampleInputPassword1t',  'value'=>$result['Clientrecource']['title'],'label' => false,'required'=>false)); ?>

                            </div>
                             <div class="form-group">
                                <label for="exampleInputPassword1">Sub-Title</label>
                                <?php echo $this->Form->input('sub_title', array('type' => 'text', 'class' => 'form-control','id' => 'exampleInputPassword1t',  'value'=>$result['Clientrecource']['sub_title'],'label' => false,'required'=>false)); ?>

                            </div>
                             <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <?php echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'exampleInputPassword1', 'label' => false, 'value' => $result['Clientrecource']['description'])); ?>

                            </div>
                            
                             <div class="form-group">
                                <label for="exampleInputPassword1">Meta Title</label>
                                <?php echo $this->Form->input('meta_title', array('type' => 'text', 'class' => 'form-control','id' => 'exampleInputPassword1t',  'value'=>$result['Clientrecource']['meta_title'],'label' => false,'required'=>false)); ?>

                            </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Url</label>
                                <?php echo $this->Form->input('url', array('type' => 'text', 'class' => 'form-control','id' => 'exampleInputPassword1t',  'value'=>$result['Clientrecource']['url'],'label' => false,'required'=>false)); ?>

                            </div>

                                  
                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>


                        </div>
                    </div>
                </section>

            </div>

        </div>
    
    </section>
</section>

<style>
    .error-message {
        background: none repeat scroll 0 0 #d50000;
        border: 1px solid #e91217;
        border-radius: 5px;
        color: #fff;
        line-height: 35px;
        margin-top: 8px;
        padding: 0 3%;
        width: 258px;
    }
</style>
