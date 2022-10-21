    <!--============= Testimonial Section Starts Here =============-->

    <section class="padding-top-200 padding-bottom pos-rel oh">

        <div class="container">        
               
                <h1 class="faq-heading">FAQ'S</h1>
                    <section class="faq-container">
                        <div class="faq-one">
                            <!-- faq question -->
                            <h1 class="faq-page">What is an FAQ Page?</h1>
                            <!-- faq answer -->
                            <div class="faq-body">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                                    necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                                    aperiam.
                                    Perspiciatis, porro!</p>
                            </div>
                        </div>
                        <hr class="hr-line">
                        <div class="faq-two">
                            <!-- faq question -->
                            <h1 class="faq-page">Why do you need an FAQ page?</h1>
                            <!-- faq answer -->
                            <div class="faq-body">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                                    necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                                    aperiam.
                                    Perspiciatis, porro!</p>
                            </div>
                        </div>
                        <hr class="hr-line">
                        <div class="faq-three">
                            <!-- faq question -->
            <h1 class="faq-page">Does it improves the user experience of a website?</h1>
                            <!-- faq answer -->
                            <div class="faq-body">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                                    necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                                    aperiam.
                                    Perspiciatis, porro!</p>
                            </div>
                        </div>
                    </section>
            </div>

        

    </section>

    <!--============= Testimonial Section Ends Here =============-->



<!--============= Call In Action Section Starts Here =============-->

    <section class="call-in-action padding-top section-last text-center ">

        <div class="container">

            <div class="section-header">

                <h6 class="title sec-last-title">Get in touch with us</h6>

            </div>

            <form class="get-in-touch-form" id="contact_form_submit">

                <div class="row">

                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <div class="form-group">

                            <input type="text" name="name" id="name" placeholder="Enter Your Full Name*">

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <div class="form-group">

                            <input type="text" name="email" id="email" placeholder="Enter Your Email*">

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">

                        <div class="form-group">

                            <input type="text" name="subject" id="subject" placeholder="Enter Your Subject*">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form-group">    

                            <textarea name="message" id="message" placeholder="Enter Your Message" cols="10"></textarea>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <div class="form-group check-group">

                            <input type="checkbox" id="check" class="check-box" required>

                            <label for="check" class="agreement-text">I consent to having this website store my submitted information so they can respond to my inquiry.</label>

                        </div>

                    </div>

                </div>

                <div class="row subit-getin-touch">

                    <div class="form-group text-center">

                        <button type="submit" class="get-in-touch-btn">Submit</button>

                    </div>

                </div>

            </form> 

        </div>

    </section>

<script type="text/javascript">
    var faq = document.getElementsByClassName("faq-page");
var i;
for (i = 0; i < faq.length; i++) {
    faq[i].addEventListener("click", function () {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
        /* Toggle between hiding and showing the active panel */
        var body = this.nextElementSibling;
        if (body.style.display === "block") {
            body.style.display = "none";
        } else {
            body.style.display = "block";
        }
    });
}
</script>