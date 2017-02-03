<section id="main-content" class="">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Add Partners</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            echo $this->Session->flash();
                            echo $this->Form->create('Partner', array('enctype' => 'multipart/form-data', 'role' => 'form', 'url' => array('controller' => 'partners', 'action' => 'add')));
                            ?>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <?php echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'id' => 'exampleInputPassword1n', 'label' => false, 'required' => false)); ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <?php echo $this->Form->input('image_name', array('type' => 'file', 'id' => 'exampleInputFileimg', 'label' => false, 'required' => false)); ?>
                            </div>         
                            <button type="submit" class="btn btn-info">Submit</button>
                            <?php echo $this->Form->end(); ?>
                        </div>
                </section>
            </div>

        </div>
        <!-- page end-->
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






