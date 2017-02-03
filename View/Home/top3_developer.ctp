<style>
    .tags {
        background: none repeat scroll 0 0 #fff;
        margin-left: 5px;
    }
</style>
<div class=" careeer client_resource">

    <div class="container">
        <div class="text_contact text-center marg_btm30 col-md-8 col-md-offset-2">

            <h3> Client Resource
            </h3><h4 class="marg_btm30">Get started with these six essential steps.</h4>

            <div class="craeer_img">

                <img class="img-responsive" src="<?php echo $this->webroot; ?>img/resource.png" alt="image">

            </div>
        </div>


    </div>
</div>

<?php if (!empty($users)) { ?>
    <div class="container">
        <div class="top3">
            <?php echo $this->Form->create('User', array('url' => array('controller' => 'home', 'action' => 'viewprofile'))); ?>
            <div class="row">
                <!--carrer top start -->
                <?php foreach ($users as $val) { ?>
                    <div class="career_top">
                        <div class="col-md-4 col-sm-4">

                            <div class="platform">
                                <i> 
                                    <?php if (!empty($val['User']['image'])) { ?>
                                        <img class="img-responsive img-circle" src="<?php echo $this->webroot; ?>uploads/<?php echo $val['User']['image']; ?>" alt="image">
                                    <?php } else { ?>
                                        <img src="/img/freelancer.png" class="img-responsive img-circle" alt="image"/>

                                    <?php } ?>
                                </i>
                                <div class="platform_content">
                                    <div class="user_val">
                                        <?php
                                        $score = 0;
                                        $ik = 0;
                                        if (!empty($val['User']['feedback'])) {

                                            $score += $val['User']['feedback']['Projectfeedback']['score'];
                                            $ik++;
                                        }
                                        if ($ik != 0) {
                                            $AvgScore = $score / $ik;
                                        } else {
                                            $AvgScore = 0;
                                        }
                                        ?>
                                        <?php $AvgScore = number_format($AvgScore, 0); ?>
                                        <div class="plat">
                                            <?php if (!empty($AvgScore)) {
                                                for ($j = 1; $j <= $AvgScore; $j++) {
                                                    ?>  

                                                    <img alt="image" src="<?php echo $this->webroot; ?>img/star.png">

                                                <?php
                                                }
                                            } else {
                                                echo 'No feedback found yet !';
                                            }
                                            ?>  
                                        </div>
                                        <p class="text-center"> <?php echo ucfirst($val['User']['first_name']) . ' ' . ucfirst($val['User']['last_name']); ?> -  <?php echo '$' . $val['User']['budget'] . '.00/hr'; ?> </p>
                                        <h5 class="text-center"> <?php echo $val['User']['job_title']; ?> </h5> 
                                        <div class="top_3">
                                            <div class="col-md-12 col-sm-10 less_skills">
                                                <?php
                                                if (!empty($val['User']['skill_name'])) {
                                                    $total_skills = count($val['User']['skill_name']);
                                                    $j = 0;
                                                    foreach ($val['User']['skill_name'] as $kk => $va) {
                                                        ?>
                                                        <span class="subskil"><?php echo $va['Subskill']['skill_name']; ?></span>
                                                        <?php
                                                        if ($j == '2') {
                                                            break;
                                                        }$j++;
                                                        ?>
            <?php
            }
        }
        ?>
        <?php if ($total_skills >= 2) { ?>
                                                    <span href="JavaScript:void(0);" class="subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More Skills </span> 

                                                <?php } ?>
                                            </div>

                                            <div class="col-md-12 col-sm-10 more_skills hide">
                                                <?php
                                                if (!empty($val['User']['skill_name'])) {
                                                    $total_skills = count($val['User']['skill_name']);
                                                    $j = 0;
                                                    foreach ($val['User']['skill_name'] as $kk => $va) {
                                                        ?>
                                                        <span class="subskil"><?php echo $va['Subskill']['skill_name']; ?></span>
                                                        <?php
                                                        $j++;
                                                        ?>
            <?php
            }
        }
        ?>

                                                <span href="JavaScript:void(0);" class="subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less Skills </span>                                  </div>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                </div>
                                <div class="coder">
                                    <div class="coder moreval">
                                        <p> <?php echo substr($val['User']['description'], 0, 150) . '...........'; ?> 
                                            <a href="JavaScript:void(0);" class="more" style="text-decoration:none;">More</a>
                                        </p>
                                    </div>
                                    <div class="coder lesval hide">
                                        <p> <?php echo $val['User']['description']; ?> 
                                            <a href="JavaScript:void(0);" class="less" style="text-decoration:none;">Less</a>
                                        </p>
                                    </div>

                                </div>



                                <p class="text-center"> <a href="<?php echo $this->Html->Url(array('controller' => 'home', 'action' => 'viewprofile', $val['User']['id'])); ?>"><button type="button"> View Profile </button></a> </p>
                            </div>

                        </div>
                    </div> 
            <?php } ?>
                <!--carrer top closed -->



            </div>  
    <?php
    echo $this->Form->end();
    ?>
        </div>
    </div>
            <?php } else {
                ?>
   
        <div class="container">
        <div class="col-md-12">
            <div class="ad_supprt">

    <?php if ($category['Category']['name'] == "Administrative Support") {
        ?><h1>The Importance of Administrative Support in a Business</h1>
                    <p>Administrative professionals are responsible for handling day to day administration for an individual or a team. They serve as the “eyes and ears of a business.” They are always expected to make critical business decisions.</p>
                    <h4>Administrative professionals should have the following basic skills:</h4>
                    <ol>
                        <li> Excellent communication skills</li>
                        <li>Computer literacy</li>
                        <li>Personable phone manner</li>
                        <li> Excellent organizational skills</li>
                        <li> Excellent time management</li>
                        <li> Attention to detail</li>
                        <li> Ability to work in a fast-paced environment</li>
                        <li> Strong work ethic</li>
                        <li>Has initiative</li>
                    </ol>
                    <p>The role of an administrative assistant can be demanding. Typical tasks include drafting letters, managing schedules, paying expenses and organizing meetings and travel itineraries. </p>
                    <p>Hiring a great administrative assistant is crucial to the success of your business. Apart from the skills already listed above, here are other skill sets that you should be looking for:</p>
                    <ul class="hrng_list">
                        <li>Leadership
                            A great administrative assistant should be able to exhibit leadership skills when working alongside business owners and leaders. He or she is not there just to wait for orders from his or her boss. All decisions made by the top management of the organization will affect the entire company. Executives should be able to rely on proactive and progressive support of their administrative staff.</li>
                        <li>
                            Willing to take risks
                            Every organization or business has limitations, especially when it comes to finances or other resources. A great administrative assistant knows how to weigh the risks against the benefits whenever an organization needs to invest in new business, purchase new materials or add new personnel.
                        </li>
                        <li>
                            The ability to think critically
                            One must-have of administrative personnel is attention to detail. This works well with leadership skills as well as the ability to think critically. A great admin is thorough and can identify potential problems or weaknesses of an organization. Critical thinking is key to finding the correct solutions to these problems and/or weaknesses.
                        </li>
                        <li>
                            Professionalism
                            The most important skill or trait of a great admin is professional integrity. Administrative personnel are privy to an organization’s human resource issues, financial statements and many other confidential information. It is imperative that the person/s you hire has/have been proven to be trustworthy and beyond reproach.
                        </li>
                    </ul>

                    <p>An ideal administrator would have all these qualities. If you find one or more from your list of candidates who have most or all of these qualities, you are on your way to success.
                    </p
            </div></div></div>

        <?php
;
    } elseif ($category['Category']['name'] == "Networking & Information Systems") {
        ?> 
        <div class="container">
        <div class="col-md-12">
            <div class="enterprise_info">

                    
                    <h1>Why Hire a Writer for Your Website?</h1>
                    <p>Many entrepreneurs would rather not hire a writer because they can write web content themselves. Maybe, if they are professional writer themselves, this may be true. However, if they don’t have professional experience in writing, they may have difficulty attaining their business goals. They would be better off hiring a professional writer to write copy for their sites.</p>
                    <h2>Following are reasons why you need to hire a professional writer for your website:</h2>
                    <ol>
                        <li> Writing is not as easy as it looks
                            Some people think spell check and/or editing software will ensure that they will have well-written, polished content for their site. Unfortunately, no matter what ads may say about these writing software, they have limitations. A professional writer knows all the rules of grammar and editing and how to appeal to readers of your content.</li>

                        <li>
                            Writing takes time
                            Even professional writers take time to write their piece because they want to provide clients with their best work. Every entrepreneur has several tasks to do and taking on the task of writing copy for his or her website will take him or her away from other important tasks that need his/her attention. Besides, if writing is not your forte, it would probably take you much longer to finish an article – compared to a veteran writer.
                        </li>
                        <li>
                            A professional writer will serve as your second set of eyes
                            Often, when you work alone, you make mistakes without realizing it. A professional writer is trained to look for mistakes in grammar, spelling, sentence structure, or ideas that may not be conveyed clearly. A veteran writer can also point out if you need to add more to your content.
                        </li>
                    </ol>
                    <h5>Hiring a good writer may be just what you need to stay ahead of your competitors. Hire a professional writer to take care of your web content and focus on other important aspects of your business.
                    </h5>
            </div></div></div>

    <?php } elseif ($category['Category']['name'] == "Writing & Translation") { ?>
  <div class="container">
        <div class="col-md-12">
            <div class="translation">     
                    <h1>The Importance of IT in Business</h1>
                    <p>Running a business today without technology is no longer possible. In fact, Information technology or IT is an integral part of every business – whether it is a startup, small business or a large corporation. In fact, IT can contribute to the success of a business and organization.</p>
                    <h3>How is IT being used in a business?</h3>
                    <ul>
                        <li>Data Management
                            The rise of the computer age has made it easier for businesses to store files. Most companies these days store digital versions of documents on servers and storage devices. This enables businesses to use office for other purposes because there is no need to keep large filing cabinets to store papers. This also helps the environment since this means there is less need for the use of paper.</li>
                        <li>Inventory Management
                            IT makes it easier for entrepreneurs to manage inventory. An inventory management system can track the quantity of products and/or supplies that a company maintains. This system triggers an order of additional stock or supplies when the quantities fall below pre-determined amounts for each item.</li>
                        <li>
                            Communication
                            Email and chat have now become the principal means of communication of most people. This is especially true for businesses. It is a fast, simple and inexpensive means to communicate. It has also enabled organizations to conduct meetings even if employees and/or customers are in different parts of the world – via video conference and/or VOIP (Voice over internet protocol) telephones or smartphones.
                        </li>
                    </ul>
                    <p>
                        In this day and age, every business needs IT. Businesses need it to keep customers happy and to keep up with competition. Information Technology is a vital part of every business. It has radically changed the lives of individuals and organizations. It has also helped increase productivity and efficiency. 
                    </p>
                    <p>
                        However, business owners should bear in mind that they have to spend a significant amount of money for IT. It is, after all, worth the investment.

                    </p>


            </div></div></div>
        <?php
    }
}
?> 
<!--                        <p class="confirm">A member of our team will be in touch with you shortly.<br>
                Can’t wait? Give us a call! +61-8-82583428</p>-->

            <!--   <form>-->
        </div>
    </div>
        </div>
</div>
<?php // }  ?>

<script>
    $(document).ready(function () {
        $(document).on('click', '.more_skill', function () {
            $(this).parent().next().removeClass('hide');
            $(this).parent().addClass('hide');
        });
        $(document).on('click', '.less_skill', function () {
            $(this).parent().prev().removeClass('hide');
            $(this).parent().addClass('hide');
        });
    });
</script>

<style>
    .enterprise_info {
  margin-top: 30px;
  margin-bottom: 50px;
}
    .enterprise_info p {
  text-align: center;
  font-size: 16px;
  line-height: 26px;
}
.enterprise_info h2{
    margin-top:30px;
    margin-bottom:20px;
}
.enterprise_info h5 {
  font-size: 16px;
  font-weight: 300;
  line-height: 26px;
}.enterprise_info ol li {
  line-height: 27px;
  margin-bottom: 20px;
  font-size: 16px;
  color: #5b5a5a;
  font-weight: 300;
}

.ad_supprt p {
  font-size: 16px;
  line-height: 24px;
  margin-bottom: 25px;
}


.ad_supprt h1{
  padding: 20px;
    text-align: center;}
.ad_supprt h4 {
  font-size: 15px;
  font-weight: 600;
}
.ad_supprt ol{
    margin-bottom:20px;
}

.ad_supprt li {
  line-height: 30px;
}
.hrng_list li {
  line-height: 28px;
  margin-bottom: 23px;
  font-size: 15px;
  color: #5b5a5a;
}

.translation li {
  line-height: 26px !important;
  margin-bottom: 20px;
  font-size:15px;
}
.translation {
    margin-bottom:60px;
}














    </style>