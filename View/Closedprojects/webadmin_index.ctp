<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading name">
                        <h4>Manage Closed Project's Detail & Feedback </h4>
                    </header>
                    <div class="col-md-6">
                    </div>
                    <div class="panel-body">
                        <section id="unseen">
                            <?php echo $this->Session->flash(); ?>
                  
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Project Title</th>
                                        <th>Client Name</th>
                                        <th>Freelancer Name</th>
                                        <th>Project Budget</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
<tbody>
                                    <?php $i=1;
                                    if(isset($feedback) && !empty($feedback)){
                                    foreach ($feedback as $message) { ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $message['Job']['job_title']; ?></td>
                                            <td><?php echo $message['Client']['first_name'].' '. $message['Client']['last_name']; ?></td>
                                            <td><?php echo $message['Freelancer']['first_name'].' '. $message['Freelancer']['last_name']; ?></td>
                                           <td>$<?php echo $message['Job']['budget'] ?></td>
                                           <td>
                                               <a href="<?php echo $this->Html->url(array('controller' => 'Closedprojects', 'action' => 'view_detail', 'prefix' => 'webadmin', $message['Job']['id'])); ?>"><button class="btn btn-primary" type="button">View</button></a>
                                               &nbsp;
                                               <a href="<?php echo $this->Html->url(array('controller' => 'Closedprojects', 'action' => 'delete', 'prefix' => 'webadmin', $message['Projectfeedback']['id'])); ?>" onclick="return confirm('Are you sure? You Want to Delete it.');"><button class="btn btn-primary" type="button">Delete</button></a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    }
                                    } ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                           <th>S.no.</th>
                                        <th>Project Title</th>
                                        <th>Client Name</th>
                                        <th>Freelancer Name</th>
                                        <th>Project Budget</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <?php echo $this->Form->end(); ?>
                            </table>
                        </section>

                        <div class="pagi ">
                            <?php ?>

                            <ul class="pagination pull-right">

                                <li><?php echo $this->Paginator->prev('<<', null, null, array('class' => 'disabled')); ?></li>
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
                                <li><?php echo $this->Paginator->next('>>', null, null, array('class' => 'disabled')); ?></li>
                            </ul>

                        </div>
                    </div>
     </section>
 </div>
        </div>

        <!-- page end-->
    </section>
</section>
<style>
    .current{
        /*background: none repeat scroll 0 0 #FF0000 !important;*/
        background: none repeat scroll 0 0 #DA423D !important;
        float: left;
        height: 34px !important;
        margin-top: 2px;
        width: 36px;
        padding-top: 6px;
        padding-left: 12px;
        color: white;
    }
    .next{
        color:white !important;
    }
    .prev{
        color:white !important;
    }

    .input-group-addon.grrenbtn {
        background: #1fb5ad;
        color: #fff;
        font-size: 14px;
    }

 .name h4{
        text-transform: none;
    }
</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
