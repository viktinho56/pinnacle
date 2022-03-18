<?php
require __DIR__. '/partials/header2.php';
require __DIR__. '/partials/navbar2.php';
?>

<div class="wrapper"  data-bs-target="#navbar-example2" data-bs-offset="0" tabindex="0">
    <section style="margin-top:80px;" id="offersection">
    <div class="row">
        <div class="col-lg-10  mx-auto col-md-10 col-sm-12">
            <div class="content" style="text-align: justify;font-size: 18px;">
                <label class="display-4 green-text center"> Privacy Policy</label>
              



<br/>
<br/>

Our Company  operates http://www.pinnaclemachinery.co.uk . This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Site.

<br/>
<br/>

We use your Personal Information only for providing and improving the Site. By using the Site, you agree to the collection and use of information in accordance with this policy.
<br/>
<br/>

<span class="text-dark">Information Collection And Use</span>
<br/>
<br/>

While using our Site, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. Personally identifiable information may include, but is not limited to your name ("Personal Information").
<br/>
<br/>

<span class="text-dark">Log Data</span>
<br/>
<br/>

Like many site operators, we collect information that your browser sends whenever you visit our Site ("Log Data").

This Log Data may include information such as your computer's Internet Protocol ("IP") address, browser type, browser version, the pages of our Site that you visit, the time and date of your visit, the time spent on those pages and other statistics.
<br/>
<br/>

In addition, we may use third party services such as Google Analytics that collect, monitor and analyze this …

The Log Data section is for businesses that use analytics or tracking services in websites or apps, like Google Analytics. For the full disclosure section, create your own Privacy Policy.
<br/>
<br/>




<span class="text-dark">Communications</span>
<br/>
<br/>

We may use your Personal Information to contact you with newsletters, marketing or promotional materials and other information that might be beneficial to you

The Communications section is for businesses that may contact users via email (email newsletters) or other methods. For the full disclosure section, create your own Privacy Policy.
<br/>
<br/>

<span class="text-dark">Cookies</span>
<br/>
<br/>
Cookies are files with small amount of data, which may include an anonymous unique identifier. Cookies are sent to your browser from a web site and stored on your computer's hard drive.
<br/>
<br/>
Like many sites, we use "cookies" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Site.
<br/>
<br/>
<span class="text-dark">Security</span>
<br/>
<br/>

The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.
<br/>
<br/>
<span class="text-dark">Changes To This Privacy Policy</span>
<br/>
<br/>

This Privacy Policy is effective as of (add date) and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.
<br/>
<br/>
We reserve the right to update or change our Privacy Policy at any time and you should check this Privacy Policy periodically. Your continued use of the Service after we post any modifications to the Privacy Policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Privacy Policy.
<br/>
<br/>
If we make any material changes to this Privacy Policy, we will notify you either through the email address you have provided us, or by placing a prominent notice on our website.
<br/>
<br/>
<span class="text-dark">Contact Us</span>
<br/>
<br/>
If you have any questions about this Privacy Policy, please contact us.

            </div>
        </div>
    </div>
  
    </section>

    </div>
    <script>
    var app = new Vue({
        el: '.wrapper',
        data() {
            return {
                
                email: "",
              
                firstname: "",
                lastname:"",
                text:""

               
            };
        },
        methods: {
            Login() {
                if (this.email == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Email can not be empty"',
                        'Okay',
                    );
                } 
                else if (this.lastname == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Lastname can not be empty"',
                        'Okay',
                    );
                } 
                else if (this.firstname == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Firstname can not be empty"',
                        'Okay',
                    );
                } 
                else if (this.text == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Text can not be empty"',
                        'Okay',
                    );
                } 
                else{
                 
                  this.SendToServer();
                }
            },
            SendToServer() {
             
                var bodyFormData = new FormData();
                
                bodyFormData.append('email', this.email);
                
                bodyFormData.append('firstname', this.firstname);
                bodyFormData.append('lastname', this.lastname);
                bodyFormData.append('text', this.text);
                

                axios({
                        method: "post",
                        url: "../../api/notification/sendContactEmail.php",
                        data: bodyFormData,
                    })
                    .then(function(response) {
                        console.log(response.data.code);
                        if (response.data.code == 1) {
                            Notiflix.Report.Success(
                                'Success',
                                '"Logged in Successfully"',
                                'Close',
                            );
                            setTimeout(function() {
                                window.location.href = 'dashboard';
                            }, 2000); //run this after 3 seconds

                        } else {
                            Notiflix.Report.Failure(
                                'Error',
                                response.data.message,
                                'Close',
                            );
                        }

                        console.log(response.data);
                    })
                    .catch(function(response) {
                        //handle error
                        console.log(response);
                    });
            }
        },
        mounted() {
           

        },

    });
</script>
<?php
require __DIR__. '/partials/footer2.php';
?>