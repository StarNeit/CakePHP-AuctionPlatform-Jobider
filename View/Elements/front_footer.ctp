
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <h3>Company Info</h3>
                <ul class="nav foot_section">
                    <li>
                        <?php echo $this->Html->link('About Us', array('controller' => 'pages', 'action' => 'aboutus')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Blogs', array('controller' => 'blogs', 'action' => 'index')); ?>
                    </li>

                    <li>
                        <?php echo $this->Html->link('Feedback', array('controller' => 'pages', 'action' => 'feedback')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Careers', array('controller' => 'careers', 'action' => 'career')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Press', array('controller' => 'pages', 'action' => 'press')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Contact Help & Support', array('controller' => 'pages', 'action' => 'contactus')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Terms Of Services', array('controller' => 'pages', 'action' => 'termsofservices')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Privacy Policy', array('controller' => 'pages', 'action' => 'privacy')); ?>
                    </li>

                    <li>
                        <?php echo $this->Html->link('Client Resources', array('controller' => 'pages', 'action' => 'clientresource')); ?>
                    </li>

                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>Additional Services</h3>
                <ul class="nav foot_section">
                    <li>
                        <a href="<?php echo $this->webroot; ?>enterprisesolutions" target="_blank">Enterprise Solution</a>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Benefits', array('controller' => 'pages', 'action' => 'benefits')); ?>
                    </li>

                </ul>
                <h3>Find Professionals</h3>
                <ul class="nav foot_section">
                    <li>
                        <?php echo $this->Html->link('Professionals By Category', array('controller' => 'findfreelancer', 'action' => 'professional_category')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Professionals By Skills', array('controller' => 'findfreelancer', 'action' => 'professional_skills')); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Professionals By Country', array('controller' => 'findfreelancer', 'action' => 'professional_country')); ?>
                    </li>
                    <li> 
                        <?php echo $this->Html->link('Find Jobs', array('controller' => 'findfreelancer', 'action' => 'findjobs')); ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>Connect with us</h3>
                <ul class="nav foot_section">
                    <li>
                        <?php echo $this->Html->link('Partner', array('controller' => 'partners', 'action' => 'partner')); ?>
                    </li>
                </ul>
                <h2 style="font-size: 20px; color: #fff !important;">Certified By</h2>
                <span id="cdSiteSeal1"><script type="text/javascript" src="//tracedseals.starfieldtech.com/siteseal/get?scriptId=cdSiteSeal1&amp;cdSealType=Seal1&amp;sealId=55e4ye7y7mb732c72a8d98835a9d1jzuzqh5y7mb7355e4ye7f5106c38fc8247f"></script></span>
            </div>
            <div class="col-md-3 col-sm-3">
                <h3>Get in Touch</h3>
                <p class="add"><span><img src="<?php echo $this->webroot; ?>img/flag.png" alt="Flag"/></span><strong>Address :</strong><?php echo $address['Address']['address']; ?></p>
                <p class="add"><span><img src="<?php echo $this->webroot; ?>img/ph.png" alt="Phone"/></span><strong>Phone :</strong><?php echo $address['Address']['phone']; ?></p>
                <p class="add"><span><img src="<?php echo $this->webroot; ?>img/ph.png" alt="Phone"/></span><strong>ABN :</strong><?php echo $address['Address']['abn_number']; ?></p>
                <p class="add"><span><img src="<?php echo $this->webroot; ?>img/msg.png" alt="message"/></span><strong>Email :</strong><?php echo $address['Address']['email']; ?></p>
                <div class="social_link">
                    <a href="https://dribbble.com/Jobider" target="_blank"><img src="<?php echo $this->webroot; ?>img/driible.png" alt="Dribble"/></a>
                    <a href="https://plus.google.com/u/0/+jafarAdam/posts" target="_blank"><img src="<?php echo $this->webroot; ?>img/gplus.png" alt="Gplus"/></a>
                    <a href="https://twitter.com/vine" target="_blank"><img src="<?php echo $this->webroot; ?>img/v.png" alt="vine"/></a>
                    <a href="https://twitter.com/Solidhds" target="_blank"><img src="<?php echo $this->webroot; ?>img/twitter.png" alt="twitter"/></a>
                    <a href="https://www.facebook.com/pages/Jobider/839942349415993" target="_blank"><img src="<?php echo $this->webroot; ?>img/fb.png" alt="facebook"/></a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <div class="container"><span>Copyright 2015, Jobider</span></div>
</div>

</body>
</html>