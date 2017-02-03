<?php
///////////////////////////User's Section///////////////////////////
if ($this->params['controller'] == 'users' && ($this->params['action'] == 'webadmin_index')) {
    $users = 'active';
} else {
    $users = '';
}
if ($this->params['controller'] == 'users' && ($this->params['action'] == 'webadmin_employer')) {
    $emp = 'active';
} else {
    $emp = '';
}

////////////////////Blog Section//////////////////////
if ($this->params['controller'] == 'blogs' && ($this->params['action'] == 'webadmin_add')) {
    $blogs_add = 'active';
} else {
    $blogs_add = '';
}
if ($this->params['controller'] == 'blogs' && ($this->params['action'] == 'webadmin_index')) {
    $blog_manage = 'active';
} else {
    $blog_manage = '';
}
///////////////////Pages Section//////////////////////
if ($this->params['controller'] == 'pages' && ($this->params['action'] == 'webadmin_add')) {
    $pages_add = 'active';
} else {
    $pages_add = '';
}
if ($this->params['controller'] == 'pages' && ($this->params['action'] == 'webadmin_index')) {
    $page_manage = 'active';
} else {
    $page_manage = '';
}
//////////////////////Careers Section////////////////////////
if ($this->params['controller'] == 'careers' && ($this->params['action'] == 'webadmin_add')) {
    $career_add = 'active';
} else {
    $career_add = '';
}
if ($this->params['controller'] == 'careers' && ($this->params['action'] == 'webadmin_index')) {
    $career_manage = 'active';
} else {
    $career_manage = '';
}
////////////////////Partner Section///////////////////////////
if ($this->params['controller'] == 'partners' && ($this->params['action'] == 'webadmin_add')) {
    $partner_add = 'active';
} else {
    $partner_add = '';
}
if ($this->params['controller'] == 'partners' && ($this->params['action'] == 'webadmin_partner')) {
    $partner_manage = 'active';
} else {
    $partner_manage = '';
}
if ($this->params['controller'] == 'partners' && ($this->params['action'] == 'webadmin_index')) {
    $partner_request = 'active';
} else {
    $partner_request = '';
}
///////////////Press Section/////////////////////////////
if ($this->params['controller'] == 'medias' && ($this->params['action'] == 'webadmin_add')) {
    $media_add = 'active';
} else {
    $media_add = '';
}
if ($this->params['controller'] == 'medias' && ($this->params['action'] == 'webadmin_index')) {
    $media_manage = 'active';
} else {
    $media_manage = '';
}
////////////////// Tests Section/////////////////////////
if ($this->params['controller'] == 'tests' && ($this->params['action'] == 'webadmin_add')) {
    $test_add = 'active';
} else {
    $test_add = '';
}
if ($this->params['controller'] == 'tests' && ($this->params['action'] == 'webadmin_index')) {
    $test_manage = 'active';
} else {
    $test_manage = '';
}
if ($this->params['controller'] == 'tests' && ($this->params['action'] == 'webadmin_addtestcontents')) {
    $testcntn_manage = 'active';
} else {
    $testcntn_manage = '';
}
if ($this->params['controller'] == 'tests' && ($this->params['action'] == 'webadmin_addQuestions')) {
    $Add_qus = 'active';
} else {
    $Add_qus = '';
}
if ($this->params['controller'] == 'tests' && ($this->params['action'] == 'webadmin_manageQuestions')) {
    $manage_qus = 'active';
} else {
    $manage_qus = '';
}
///////////////////////Banner Section/////////////////////////
if ($this->params['controller'] == 'banners' && ($this->params['action'] == 'webadmin_add')) {
    $banner_add = 'active';
} else {
    $banner_add = '';
}
if ($this->params['controller'] == 'banners' && ($this->params['action'] == 'webadmin_index')) {
    $banner_manage = 'active';
} else {
    $banner_manage = '';
}
/////////////////////////Faq section /////////////////////////////
if ($this->params['controller'] == 'faqs' && ($this->params['action'] == 'webadmin_add')) {
    $faq_add = 'active';
} else {
    $faq_add = '';
}
if ($this->params['controller'] == 'faqs' && ($this->params['action'] == 'webadmin_index')) {
    $faq_manage = 'active';
    $style = "display: block;";
} else {
    $style = "";
    $faq_manage = '';
}
///////////////////////Category Section///////////////////////
if ($this->params['controller'] == 'categories' && ($this->params['action'] == 'webadmin_add')) {
    $category_add = 'active';
} else {
    $category_add = '';
}
if ($this->params['controller'] == 'subcategories' && ($this->params['action'] == 'webadmin_add')) {
    $subcategory_add = 'active';
} else {
    $subcategory_add = '';
}
if ($this->params['controller'] == 'categories' && ($this->params['action'] == 'webadmin_index')) {
    $category_manage = 'active';
} else {
    $category_manage = '';
}
////////////////Skills Section ////////////////////
if ($this->params['controller'] == 'skills' && ($this->params['action'] == 'webadmin_add')) {
    $skill_add = 'active';
} else {
    $skill_add = '';
}
if ($this->params['controller'] == 'subskills' && ($this->params['action'] == 'webadmin_add')) {
    $subskill_add = 'active';
} else {
    $subskill_add = '';
}
if ($this->params['controller'] == 'skills' && ($this->params['action'] == 'webadmin_index')) {
    $skill_manage = 'active';
} else {
    $skill_manage = '';
}

/////////////////////JobCategory Section////////////////////////
if ($this->params['controller'] == 'jobcategory' && ($this->params['action'] == 'webadmin_add')) {
    $jobcat_add = 'active';
} else {
    $jobcat_add = '';
}
if ($this->params['controller'] == 'jobcategory' && ($this->params['action'] == 'webadmin_addSubcategory')) {
    $jobsubcat_add = 'active';
} else {
    $jobsubcat_add = '';
}
if ($this->params['controller'] == 'jobcategory' && ($this->params['action'] == 'webadmin_index')) {
    $jobcat_manage = 'active';
} else {
    $jobcat_manage = '';
}
/////////////Feedback Details Section////////////////////
if ($this->params['controller'] == 'pages' && ($this->params['action'] == 'webadmin_feedbackdetail')) {
    $feedback_manage = 'active';
} else {
    $feedback_manage = '';
}
///////////////////Contact Us details///////////////////////
if ($this->params['controller'] == 'dashboard' && ($this->params['action'] == 'webadmin_contact_us_details')) {
    $contact_us_manage = 'active';
} else {
    $contact_us_manage = '';
}
if ($this->params['controller'] == 'pages' && ($this->params['action'] == 'webadmin_address') && ($this->params['pass'][0] == '1')) {
    $site_address_manage = 'active';
} else {
    $site_address_manage = '';
}
///////////////////Help Section//////////////////////
if ($this->params['controller'] == 'helps' && ($this->params['action'] == 'webadmin_add')) {
    $help_add = 'active';
} else {
    $help_add = '';
}
if ($this->params['controller'] == 'helps' && ($this->params['action'] == 'webadmin_index')) {
    $help_manage = 'active';
} else {
    $help_manage = '';
}
////////////////Settings Section/////////////////
if ($this->params['controller'] == 'users' && ($this->params['action'] == 'webadmin_changepassword')) {
    $changepwd = 'active';
} else {
    $changepwd = '';
}
///////////////////Enterprise Solution //////////////////////////////
if ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'webadmin_add')) {
    $solution_add = 'active';
} else {
    $solution_add = '';
}
if ($this->params['controller'] == 'enterprisesolutions' && ($this->params['action'] == 'webadmin_index')) {
    $solution_manage = 'active';
} else {
    $solution_manage = '';
}
///////////////////Payment Management //////////////////////////////
if ($this->params['controller'] == 'payments' && ($this->params['action'] == 'webadmin_index')) {
    $payment = 'active';
} else {
    $payment = '';
}
if ($this->params['controller'] == 'payments' && ($this->params['action'] == 'webadmin_creditcard')) {
    $payment_credit = 'active';
} else {
    $payment_credit = '';
}
if ($this->params['controller'] == 'dashboard' && ($this->params['action'] == 'membership_plans')) {
    $membership = 'active';
} else {
    $membership = '';
}
/////////////////// CLosed Projects //////////////////////////////
if ($this->params['controller'] == 'Closedprojects' && ($this->params['action'] == 'webadmin_index')) {
    $close = 'active';
} else {
    $close = '';
}

///////////////////////////////////////////////
?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li> 
                    <a  href="<?php echo $this->Html->Url(array('controller' => 'dashboard', 'action' => 'index')); ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a  href="javascript:;" class="">
                        <i class="fa fa-home"></i>
                        <span>Home Page</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="<?php echo $this->Html->Url(array('controller' => 'home', 'action' => 'homecontent/1')); ?>">Manage Home Page Content</a></li>
                    </ul>
                </li>   
                <li class="sub-menu">
                    <a  href="javascript:;" class="">
                        <i class="fa fa-chain-broken"></i>
                        <span> Client Resources </span>
                    </a>
                    <ul class="sub">
                        <li><a  href="<?php echo $this->Html->Url(array('controller' => 'home', 'action' => 'Client_recources/1')); ?>">Manage Client Resource Content</a>
                        </li>
                    </ul> 
                </li>                    
                <li class="sub-menu">
                    <a  href="javascript:;" class="">
                        <i class="fa fa-indent"></i>
                        <span> Client Manuals </span>
                    </a>
                    <ul class="sub">
                        <li><a  href="<?php echo $this->Html->Url(array('controller' => 'clientmanuals', 'action' => 'add')); ?>">add Client Manuals</a>
                        </li>
                        <li><a  href="<?php echo $this->Html->Url(array('controller' => 'clientmanuals', 'action' => 'index')); ?>">Manage Client Manuals</a>
                        </li>
                    </ul>
                </li>    

                <li class="sub-menu">
                    <?php
                    if (!empty($users)) {
                        $users_1 = 'active';
                    } elseif (!empty($emp)) {
                        $users_1 = 'active';
                    } else {
                        $users_1 = '';
                    }
                    ?>

                    <a  href="javascript:;" class="<?php echo $users_1; ?>">
                        <i class="fa fa-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $users; ?>"><a  href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'index')); ?>">Freelancers</a></li>
                        <li class="<?php echo $emp; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'employer')); ?>"> Clients</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($blogs_add)) {
                        $blogs_add_1 = 'active';
                    } elseif (!empty($blog_manage)) {
                        $blogs_add_1 = 'active';
                    } else {
                        $blogs_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $blogs_add_1; ?>">
                        <i class="fa fa-book"></i>
                        <span>Blogs</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $blogs_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'blogs', 'action' => 'add')); ?>">Add Blog</a></li>
                        <li class="<?php echo $blog_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'blogs', 'action' => 'index')); ?>">Manage Blogs</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($pages_add)) {
                        $pages_add_1 = 'active';
                    } elseif (!empty($page_manage)) {
                        $pages_add_1 = 'active';
                    } else {
                        $pages_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $pages_add_1; ?>">
                        <i class="fa fa-paperclip"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $pages_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'add')); ?>">Add Page</a></li>
                        <li class="<?php echo $page_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'index')); ?>">Manage Pages</a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($career_add)) {
                        $career_add_1 = 'active';
                    } elseif (!empty($career_manage)) {
                        $career_add_1 = 'active';
                    } else {
                        $career_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $career_add_1; ?>">
                        <i class="fa fa-chain"></i>
                        <span>Careers</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $career_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'careers', 'action' => 'add')); ?>">Add Careers</a></li>
                        <li class="<?php echo $career_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'careers', 'action' => 'index')); ?>"> Manage Careers </a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($partner_add)) {
                        $partner_add_1 = 'active';
                    } elseif (!empty($partner_manage)) {
                        $partner_add_1 = 'active';
                    } elseif (!empty($partner_request)) {
                        $partner_add_1 = 'active';
                    } else {
                        $partner_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $partner_add_1; ?>">
                        <i class="fa fa-group"></i>
                        <span>Partners</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $partner_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'partners', 'action' => 'add')); ?>">Add Partners</a></li>  
                        <li class="<?php echo $partner_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'partners', 'action' => 'partner')); ?>">Manage Partners</a></li>
                        <li class="<?php echo $partner_request; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'partners', 'action' => 'index')); ?>">Partner Request </a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($media_add)) {
                        $media_add_1 = 'active';
                    } elseif (!empty($media_manage)) {
                        $media_add_1 = 'active';
                    } else {
                        $media_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $media_add_1; ?>">
                        <i class="fa fa-bullhorn"></i>
                        <span>Press Management</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $media_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'medias', 'action' => 'add')); ?>">Add   Media</a></li>
                        <li class="<?php echo $media_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'medias', 'action' => 'index')); ?>">Manage   Media</a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($test_add)) {
                        $test_add_1 = 'active';
                    } elseif (!empty($test_manage)) {
                        $test_add_1 = 'active';
                    } elseif (!empty($testcntn_manage)) {
                        $test_add_1 = 'active';
                    } elseif (!empty($Add_qus)) {
                        $test_add_1 = 'active';
                    } elseif (!empty($manage_qus)) {
                        $test_add_1 = 'active';
                    } else {
                        $test_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $test_add_1; ?>">
                        <i class="fa fa-book"></i>
                        <span>Tests Management</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $test_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'tests', 'action' => 'add')); ?>">Add Tests</a></li>

                        <li class="<?php echo $Add_qus; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'tests', 'action' => 'addQuestions')); ?>">Add Questions</a></li>
                        <li class="<?php echo $testcntn_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'tests', 'action' => 'addtestcontents')); ?>">Add Test Contents</a></li>
                        <li class="<?php echo $test_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'tests', 'action' => 'index')); ?>">Manage Tests</a></li>
                        <li class="<?php echo $manage_qus; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'tests', 'action' => 'manageQuestions')); ?>">Manage Questions</a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($banner_add)) {
                        $banner_add_1 = 'active';
                    } elseif (!empty($banner_manage)) {
                        $banner_add_1 = 'active';
                    } else {
                        $banner_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $banner_add_1; ?>">
                        <i class="fa fa-camera-retro"></i>
                        <span> Banner Management</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $banner_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'banners', 'action' => 'add')); ?>">Add Banners  </a>
                        </li>
                        <li class="<?php echo $banner_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'banners', 'action' => 'index')); ?>">Manage Banners  </a></li>

                    </ul> 
                </li>


                <li class="sub-menu">
                    <?php
                    if (!empty($solution_add)) {
                        $solution_add_1 = 'active';
                    } elseif (!empty($solution_manage)) {
                        $solution_add_1 = 'active';
                    } else {
                        $solution_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $solution_add_1; ?>">
                        <i class="fa fa-camera-retro"></i>
                        <span> Services  Management</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $solution_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'enterprisesolutions', 'action' => 'index')); ?>">Manage Enterprise Solutions   </a></li>

                    </ul> 
                </li>


                <li class="sub-menu">
                    <?php
                    if (!empty($payment)) {
                        $payments = 'active';
                    } elseif ($payment_credit) {
                        $payments = 'active';
                    } else {
                        $payments = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $payments; ?>">
                        <i class="fa fa-book"></i>
                        <span> Payment Management</span>
                    </a>
                    <ul class="sub">

                        <li class="<?php echo $payment; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'payments', 'action' => 'index', 'prefix' => 'webadmin')); ?>">Paypal Payment </a></li>
                        <li class="<?php echo $payment_credit; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'payments', 'action' => 'creditcard', 'prefix' => 'webadmin')); ?>">Credit Card Payment </a></li>
                        <li class="<?php echo $payment_credit; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'payments', 'action' => 'completedWithdrawRequests', 'prefix' => 'webadmin')); ?>">Completed Withdraw Requests </a></li>
                    </ul>   
                </li>
                
             
                     <li class="sub-menu">
                    <?php
                    if (!empty($membership)) {
                        $membership = 'active';
                    } else {
                        $membership = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $membership; ?>">
                        <i class="fa fa-book"></i>
                        <span> Membership Plans</span>
                    </a>
                    <ul class="sub">

                        <li class="<?php echo $membership; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'dashboard', 'action' => 'membership_plans', 'prefix' => 'webadmin')); ?>">View Membership Plans </a></li>
                      
                    </ul>   
                </li>
                
                         <li class="sub-menu">
                    <?php
                    if (!empty($close)) { 
                        $closed = 'active';
                    }else{
                        $closed='';
                    } 
                    ?>
                    <a href="javascript:;" class="<?php echo $closed; ?>">
                        <i class="fa fa-tasks"></i>
                        <span> Closed Projects & Feedback</span>
                    </a>
                    <ul class="sub">

                        <li class="<?php echo $closed; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'Closedprojects', 'action' => 'index', 'prefix' => 'webadmin')); ?>">View Closed Projects</a></li>
                        
                    </ul>   
                </li>
                

                <li class="sub-menu">
                    <?php
                    if (!empty($paypal)) {
                        $paypal_setting = 'active';
                    }else {
                        $paypal_setting = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $paypal_setting; ?>">
                        <i class="fa fa-book"></i>
                        <span> Paypal Setting</span>
                    </a>
                    <ul class="sub">

                        <li class="<?php echo $paypal_setting; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'payments', 'action' => 'paypal', 'prefix' => 'webadmin')); ?>">Paypal Setting </a></li>
                      
                    </ul>   
                </li>
                
                
                
                
                <li class="sub-menu">
                    <?php
                    if (!empty($faq_add)) {
                        $faq_add_1 = 'active';
                    } elseif (!empty($faq_manage)) {
                        $faq_add_1 = 'active';
                    } else {
                        $faq_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $faq_add_1; ?>">
                        <i class="fa fa-book"></i>
                        <span>Faq</span>
                    </a>

                    <ul  class="sub">
                        <li class="<?php echo $faq_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'faqs', 'action' => 'add')); ?>">Add Faq</a></li>
                        <li  class="<?php echo $faq_manage; ?>">
                            <a  href="<?php echo $this->Html->Url(array('controller' => 'faqs', 'action' => 'index')); ?>">Manage Faq </a>
                        </li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($category_add)) {
                        $category_add_1 = 'active';
                    } elseif (!empty($category_manage)) {
                        $category_add_1 = 'active';
                    } elseif (!empty($subcategory_add)) {
                        $category_add_1 = 'active';
                    } else {
                        $category_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $category_add_1; ?>">
                        <i class="fa fa-eye"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $category_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'categories', 'action' => 'add')); ?>">Add Category </a></li>
                        <li class="<?php echo $subcategory_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'subcategories', 'action' => 'add')); ?>">Add Subcategory </a></li>
                        <li class="<?php echo $category_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'categories', 'action' => 'index')); ?>">Manage Category </a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($skill_add)) {
                        $skill_add_1 = 'active';
                    } elseif (!empty($skill_manage)) {
                        $skill_add_1 = 'active';
                    } elseif (!empty($subskill_add)) {
                        $skill_add_1 = 'active';
                    } else {
                        $skill_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $skill_add_1; ?>">
                        <i class="fa fa-flask"></i>
                        <span> Skills </span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $skill_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'skills', 'action' => 'add')); ?>">Add Skills  </a></li>
                        <li class="<?php echo $subskill_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'subskills', 'action' => 'add')); ?>">Add Subskills  </a></li>
                        <li class="<?php echo $skill_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'skills', 'action' => 'index')); ?>">Manage  Skills  </a></li>
                    </ul>     
                </li>
             
                <li class="sub-menu">
                    <a href="javascript:;" class="<?php echo $feedback_manage; ?>">
                        <i class="fa fa-refresh"></i>
                        <span>Feedback Details</span>  
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $feedback_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'feedbackdetail')); ?>">Manage Feedback  Details </a></li>
                        <li class="<?php echo $feedback_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'managequestions')); ?>">Manage How It Works  Questions </a></li><li class="<?php echo $feedback_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'addquestions')); ?>">Add How It Works  Questions </a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($contact_us_manage)) {
                        $contact_us_manage_1 = 'active';
                    } elseif (!empty($site_address_manage)) {
                        $contact_us_manage_1 = 'active';
                    } else {
                        $contact_us_manage_1 = '';
                    }
                    ?>

                    <a href="javascript:;" class="<?php echo $contact_us_manage_1; ?>">
                        <i class="fa fa-envelope-o"></i>
                        <span>Contact Us Details</span>  
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $contact_us_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'dashboard', 'action' => 'contact_us_details')); ?>">Manage Contact Us Details </a></li>
                        <li class="<?php echo $site_address_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'pages', 'action' => 'address/1')); ?>">Manage Site Address Details </a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <?php
                    if (!empty($help_add)) {
                        $help_add_1 = 'active';
                    } elseif ($help_manage) {
                        $help_add_1 = 'active';
                    } else {
                        $help_add_1 = '';
                    }
                    ?>
                    <a href="javascript:;" class="<?php echo $help_add_1; ?>">
                        <i class="fa fa-question"></i>
                        <span>Help</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $help_add; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'helps', 'action' => 'add')); ?>">Add Help Content</a></li>
                        <li class="<?php echo $help_manage; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'helps', 'action' => 'index')); ?>">Manage Help Content</a></li>
                    </ul>     
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="<?php echo $changepwd; ?>">
                        <i class="fa fa-cogs"></i>
                        <span> Settings</span>
                    </a>
                    <ul class="sub">
                        <li class="<?php echo $changepwd; ?>"><a href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'changepassword')); ?>">Change Password  </a></li>
                    </ul>   
                </li>



            </ul>   
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
