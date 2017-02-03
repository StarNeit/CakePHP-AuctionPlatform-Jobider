<div class="modal-dialog">
    <div class="modal-content">
        <?php echo $this->Form->create('Testcontent', array('role' => 'form', 'url' => array('controller' => 'tests', 'action' => 'preview', $faq_data['Testcontent']['id']))); ?>
        <div class="green_header">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Preview Test Content</h4>
            </div>
        </div>
        <div class="modal-body"> 
            <div class="modal_content">
                <div class="col-md-12">
                    <div class="form-group">
                        <label> Category &nbsp;&nbsp;&nbsp;</label>
                        <strong> <?php echo $cat_name['Category']['name']; ?></strong>
                    </div>

                    <div class="form-group">
                        <label>Test &nbsp;&nbsp;&nbsp; </label>
                        <strong><?php echo $test['Test']['title']; ?></strong>
                    </div>
                    <div class="form-group">
                        <label>Test Content &nbsp;&nbsp;&nbsp;</label>
                        <strong>      <?php echo $faq_data['Testcontent']['test_content']; ?></strong>
                    </div>
                    <div class="form-group">
                        <label> Creation Date &nbsp;&nbsp;&nbsp;</label>
                        <strong>       <?php echo $date = date('F d Y h:i A', strtotime($faq_data['Testcontent']['created'])); ?></strong>
                    </div>
                    <div class="form-group">
                        <label> Status &nbsp;&nbsp;&nbsp;</label>
                        <?php
                        if ($faq_data['Testcontent']['status'] == '1') {
                            echo "<strong>Active</strong>";
                        } else {
                            echo "<strong>Inactive</strong>";
                        }
                        ?>
                    </div>

                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>