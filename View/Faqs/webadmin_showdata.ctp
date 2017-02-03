<div class="modal-dialog">
    <div class="modal-content">
        <?php echo $this->Form->create('Faq', array('role' => 'form', 'url' => array('controller' => 'faqs', 'action' => 'preview', $faq_data['Faq']['id']))); ?>
        <div class="green_header">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Preview Add FAQ</h4>
            </div>
        </div>

        <div class="modal-body">
            <div class="modal_content">
                <div class="col-md-12">
                    <div class="form-group">
                        <label> Question &nbsp;&nbsp;&nbsp;</label>
                        <?php echo $faq_data['Faq']['question']; ?>
                    </div>

                    <div class="form-group">
                        <label>Answer</label>
                        <p style="text-align: justify;"><?php echo $faq_data['Faq']['answer']; ?><p>
                    </div>
                    <div class="form-group">
                        <label> Creation Date &nbsp;&nbsp;&nbsp;</label>
                        <?php echo $date = date('F d Y h:i A', strtotime($faq_data['Faq']['created'])); ?>
                    </div>
                    <div class="form-group">
                        <label> Status &nbsp;&nbsp;&nbsp;</label>
                        <?php
                        if ($faq_data['Faq']['status'] == '1') {
                            echo "Active";
                        } else {
                            echo "Inactive";
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