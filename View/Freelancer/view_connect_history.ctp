<div class="container">
    <div class="freelancer_profile_content1">

        <div class="table-responsive">
            <table class="table cust_table11 table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Client</th>
                        <th>Connects Type</th>
                        <th class="set">Amount</th>
                        <th class="set">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($job_detail)) { ?>
                        <?php foreach ($job_detail as $k => $v) { ?>  
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($v['Jobdetail']['created'])); ?></td>
                                <td class="table_result"> <?php echo $v['Jobdetail']['contect_type']; ?> Submission<br>
                                    <a href="<?php echo $this->webroot;?>freelancer/jobdetails/<?php echo $v['Job']['id'];?>"><?php echo $v['Job']['job_title']; ?></a>

                                </td>
                                <td> <?php echo $v['client']['User']['first_name'] . ' ' . $v['client']['User']['last_name']; ?> </td>
                                <td><?php echo $v['Jobdetail']['contect_type']; ?></td>
                                <td class="set"><?php echo '(' . $v['Jobdetail']['used_connects'] . ')'; ?></td>
                                <td class="set"><?php echo $v['Jobdetail']['remain_connects']; ?></td>
                            </tr>

                        <?php } ?>       

                    <?php } else { ?>

                    <tbody>
<?php foreach($user_data as $kk=>$vv){ ?>
                        <tr>
                            <td><?php echo date('d/m/Y',strtotime($vv['User']['created'])); ?></td>
                            <td>    <?php echo $vv['User']['membership_type'].'     membership connects' ?>   </td>
                            <td> - </td>
                            <td><?php echo $vv['User']['membership_type']; ?> </td>
                            <td class="set"><?php echo $vv['User']['connects']; ?></td>
                            <td class="set"><?php  $used_connect=$vv['User']['connects']-$vv['User']['used_connects'];  echo $used_connect;?></td>
                        </tr>

<?php } ?>






                    </tbody>

                <?php } ?>


                </tbody>
            </table>
            <?php if (!empty($job_detail)or !empty($user_data)) { ?>
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
            <?php } ?>
        </div>




    </div>




</div>
