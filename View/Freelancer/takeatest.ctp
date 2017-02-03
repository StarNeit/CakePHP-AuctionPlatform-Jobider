<div class="container">
    <div class="row marg_tb15">
        <?php echo $this->element('freelancer_dashboard'); ?>
        <div class="col-md-9 col-sm-9">
            <h3 class="marg_0 text_1">Skill Test </h3>
            <p class="marg_tb15 font_18 text_1">
                Prove your skills and impress potential clients by taking a few free Jobider tests ! The more relevant tests you pass, the more professional you look. Read the test &nbsp;<a href="<?php echo $this->webroot; ?>freelancer/OnlineTestPolicy" target="_blank">policies & rules </a>&nbsp;before starting any tests. 
            </p>
            <?php
            if (isset($errors) and !empty($errors)) {
                ?>
                <div class="alert alert-danger ">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>X</button>
                    <h4>
                        <i class="icon-ok-sign"></i>
                    </h4>
                    <?php foreach ($errors as $k => $v) { ?>
                        <h4><b><?php echo $v; ?></b></h4>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="bg_grey1">
                <div class="apply_jobform  padd_30">
                    <?php
                    echo $this->Session->flash();
                    echo $this->Form->create('Test', array('url' => array('controller' => 'freelancer', 'action' => 'takeatest'), 'role' => 'form', 'class' => 'skill_form'));
                    ?>
                    <div class="col-md-4">
                        <?php echo $this->Form->input('select', array('class' => 'pull-left col-md-12', 'type' => 'select', 'label' => false, 'options' => array('' => 'All Categories', $categories))); ?>
                        <div class="clearfix"></div>
                    </div>
                    <?php if(!empty($this->request->data['Test']['search_keyword'])){
                        $value=$this->request->data['Test']['search_keyword'];
                    }else{
                        $value='';
                    } ?>
                    <div class="col-md-4">
                        <input type="text" class="pull-left col-md-12" placeholder="Keywords" name="data[Test][search_keyword]" value="<?php echo $value; ?>" >
                        <div class="clearfix"></div>
                    </div>
                    <button class="btn btn-green " type="submit">Search</button>
                    <?php echo $this->Form->end(); ?>
                    <div class="clearfix"></div>
                </div>

            </div>

            <div class="bg_white marg_tb50">
                <div class="table-responsive">
                    <table class="table cust_table11 table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($Test_title) and !empty($Test_title)) {
                                foreach ($Test_title as $val) {
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo $this->webroot; ?>freelancer/TakeTestOnClick/<?php echo $val['Test']['slug']; ?>" style="text-decoration: none"><?php echo $val['Test']['title']; ?></a></td>
                                        <td>  <?php echo $val['Category']['name'] ?></td>
                                    </tr>
                                    <?php } } else { ?>
                                <tr>
                                    <td colspan="6"> 
                                        <div class="alert alert-danger " style="text-align: center">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                                X</button>
                                            <h4>
                                                <i class="icon-ok-sign"></i>
                                            </h4>

                                            <h4><b>Sorry! There is  No Record(s) Found !</b></h4>

                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
          <ul class="pagination pull-right">
  <li><?php echo $this->Paginator->prev('<<Previous', null, null, array('class' => 'disabled')); ?></li>
  <?php
  echo $this->Paginator->numbers(array(
      'before' => '',
      'after' => '',
      'separator' => '',
      'tag' => 'li',
      'spanClass' => 'sr-only',
      'currentClass' => 'active',
      'currentTag' => 'a',
  ));
  ?> 
  <li><?php echo $this->Paginator->next('Next>>', null, null, array('class' => 'disabled')); ?></a></li>
 </ul>    
            
        </div>

    </div>

</div>

<style>
    button.close {
        background: none repeat scroll 0 0 transparent;
        border: 0 none;
        color: #a94442;
        cursor: pointer;
        padding: 0;
    }


</style>